<?php

namespace App\Admin\Controllers;

use App\Time;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;
use Carbon\Carbon;

class TimesController extends Controller
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
            ->header('Time')
            ->description('')
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
            ->description('description')
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
            ->description('description')
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
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Time);
        $grid->model()->orderBy('time', 'asc');
        $grid->id('ID');
        $grid->time('Time')->display(function ($s) {
            return Carbon::parse($s)->format("g:i A")?: 'n/a';
        })->badge('orange')->sortable();
        $states = [
            'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'NO', 'color' => 'danger'],
        ];
        $grid->toiiuc('To IIUC Campus')->switch($states)->sortable();
        $grid->fromiiuc('From IIUC Campus')->switch($states)->sortable();
        $grid->active('Published')->switch($states)->sortable();
        $grid->user_id('Created By')->display(function ($s) {
            return Administrator::all()->find($s)->name?: 'n/a';
        })->label('primary');
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');
        $grid->disableFilter();
        $grid->disablePagination();

        //$grid->disableTools();
       //$grid->disableRowSelector();

//        $grid->tools(function (Grid\Tools $tools) {
//            $tools->batch(function (Grid\Tools\BatchActions $actions) {
//                //$actions->disableDelete();
//            });
//        });

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
        $show = new Show(Time::findOrFail($id));

        $show->id('ID');
        $show->time('Time')->as(function ($s) {
            return Carbon::parse($s)->format("g:i A");
        })->badge('orange');
        $states = [
            'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'NO', 'color' => 'danger'],
        ];
        $show->toiiuc('To IIUC Campus')->as(function ($s) {
            return $s ? 'Yes' : 'No';
        });
        $show->fromiiuc('From IIUC Campus')->as(function ($s) {
            return $s ? 'Yes' : 'No';
        });
        $show->user_id('Created By')->as(function ($s) {
            return Administrator::all()->find($s)->name;
        })->label('primary');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Time);

        $form->time('time', 'Time')->default(date('H:i:s'));
        $form->switch('toiiuc', 'To IIUC Campus');
        $form->switch('fromiiuc', 'From IIUC Campus');
        $states = [
            'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $form->switch('active','Published')->states($states);
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });

        return $form;
    }
}
