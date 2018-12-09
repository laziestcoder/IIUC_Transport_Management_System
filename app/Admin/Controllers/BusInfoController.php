<?php

namespace App\Admin\Controllers;

use App\BusInfo;
use App\BusType;
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
        $grid->insurance_no('Insurance No')->sortable();
        $grid->insurance_validity('Insurance Validity')->sortable();
        $grid->route_permit('Route Permit')->sortable();
        $grid->route_permit_validity('Route Permit Validity')->sortable();
        $grid->seat('Seat Capacity')->sortable();
        $states = [
            'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'NO', 'color' => 'danger'],
        ];
        $grid->availability('Availability')->switch($states)->sortable();
        $grid->bustype('Bus Type')->pluck('name')->display(function ($bustype) {
            $s = BusType::all()->find($bustype);
            if ($s) {
                return $s->name;
            } else {
                return 'n/a';
            }
        })->sortable();
        $grid->bus_name('Bus Name')->sortable();
        $grid->busowner('Bus Owner')->sortable();
        $grid->comments('Comments');
//        $grid->user_id('Created By')->display(function ($s) {
//            return Administrator::all()->find($s)->name;
//        })->sortable()->label();
//        $grid->created_at('Created At')->sortable();
        $grid->updated_at('Last Updated')->sortable();
        $grid->filter(function ($filter) {
            // Sets the range query for the created_at field
            //$filter->expand();
            $filter->disableIdFilter();
            $filter->like('busid','Bus ID');
            $filter->like('registration','Registration No');
            $filter->like('license', 'License No');
            });
        //$grid->expandFilter();
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
        $show->insurance_no('Insurance No');
        $show->insurance_validity('Insurance Validity');
        $show->route_permit('Route Permit');
        $show->route_permit_validity('Route Permit Validity');
        $show->seat('Seat Capacity');
        $show->availability('Availability')->as(function ($s) {
            return $s ? "<span class='label label-success'>Yes</span>" : "<span class='label label-danger'>No</span>";
        });
        $show->bustype('Bus Type')->as(function ($bustype) {
            return BusType::all()->find($bustype)->name;
        });
        $show->bus_name('Bus Name');
        $show->busowner('Bus Owner');
        $show->comments('Comments');
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


        $form->text('busid', 'Bus ID')->rules('required');
        $form->text('registration', 'Registration No')->rules('required');
        $form->text('license', 'License No')->rules('required');
        $form->text('insurance_no','Insurance No')->rules('required');
        $form->date('insurance_validity','Insurance Validity')->rules('required');
        $form->text('route_permit','Route Permit')->rules('required');
        $form->date('route_permit_validity','Route Permit Validity')->rules('required');
        $form->number('seat', 'Seat Capacity')->rules('required');
        $states = [
            'on' => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $form->switch('availability', 'Availability')->states($states);
        $form->select('bustype','Bus Type')->options(BusType::all()->pluck('name', 'id'))->rules('required');
        $form->text('bus_name','Bus Name')->rules('required');
        $form->text('busowner','Bus Owner')->rules('required');
        $form->text('comments','Comments');
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });

        return $form;
    }
}
