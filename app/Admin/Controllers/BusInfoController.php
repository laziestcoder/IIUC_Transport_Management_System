<?php

namespace App\Admin\Controllers;

use App\BusInfo;
use App\Http\Controllers\Controller;
use DB;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

//use Encore\Admin\Admin;


class BusInfoController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Bus Information')
            ->description('List')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BusInfo);

        $grid->id('ID')->sortable();
        $grid->busid('Bus ID')->sortable();
        $grid->registration('Registration No')->sortable();
        $grid->license('License No')->sortable();
        $grid->seat('Seat Capacity')->sortable();
        $grid->availability('Availability')->display(function ($s) {
            return $s ? "<span class='label label-success'>Yes</span>" : "<span class='label label-danger'>No</span>";
        })->sortable();
        $grid->user_id('Created By')->display(function ($s) {
            return Administrator::all()->find($s)->name;
        })->sortable()->label();
        $grid->created_at('Created At')->sortable();
        $grid->updated_at('Updated At')->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(BusInfo::findOrFail($id));
        $show->panel()
            //->style('danger') // could be primary, info, danger, warning, default
            ->title('Details');

        $show->id('ID');
        $show->busid('Bus ID');
        $show->registration('Registration No');
        $show->license('License No');
        $show->seat('Seat Capacity');
        $show->availability('Availability')->as(function ($s) {
            return $s ? "<span class='label label-success'>Yes</span>" : "<span class='label label-danger'>No</span>";
        });
        $show->user_id('Created By')->as(function ($s) {
            return Administrator::all()->find($s)->name;
        })->label();
        $show->created_at('Created At');
        $show->updated_at('Updated At');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BusInfo);


        $form->text('busid', 'Bus ID');
        $form->text('registration', 'Registration No');
        $form->text('license', 'License No');
        $form->number('seat', 'Seat Capacity');
        $states = [
            'on' => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $form->switch('availability', 'Availability')->states($states);
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });

        return $form;
    }
}
