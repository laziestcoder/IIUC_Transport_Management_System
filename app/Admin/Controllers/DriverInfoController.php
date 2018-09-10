<?php

namespace App\Admin\Controllers;

use App\Driver;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class DriverInfoController extends Controller
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
            ->header('Driver Information')
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
        $grid = new Grid(new Driver);

        $grid->id('ID');
        $grid->image('Photo')->display(function ($s) {
            return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='/storage/" . $s . "' alt='" . $this->name . "'/>";
        });
        $grid->name('Name');
        $grid->gender('Gender')->display(function ($s) {
            return $s ? 'Female' : 'Male';
        });
        $grid->nid('NID');
        $grid->driverid('Driver ID');
        $grid->licensepic('License Photo')->display(function ($s) {
            return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='/storage/" . $s . "' alt='" . $this->name . "'/>";
        });
        $grid->license('License No');
        $grid->contactno('Contact No');
        $grid->busno('Bus No');
        $grid->address('Address');

        $grid->created_at('Created At');
        $grid->updated_at('Updated At');

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
        $show = new Show(Driver::findOrFail($id));
        $show->panel()
            ->title(trans('Driver Details'));

        $show->id('ID');
        $show->image('Photo')->as(function ($s) {
            return "<img style='max-width:200px;max-height:200px' class='img img-thumbnail' src='/storage/" . $s . "' alt='" . $this->name . "'/>";
        });
        $show->name('Name');
        $show->gender('Gender')->as(function ($s) {
            return $s ? 'Female' : 'Male';
        });
        $show->nid('NID');
        $show->driverid('Driver ID');
        $show->licensepic('License Photo')->as(function ($s) {
            return "<img style='max-width:200px;max-height:200px' class='img img-thumbnail' src='/storage/" . $s . "' alt='" . $this->name . "'/>";
        });
        $show->license('License No');
        $show->contactno('Contact No');
        $show->busno('Bus No');
        $show->address('Address');
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
        $form = new Form(new Driver);

        $form->text('name', 'Name')->rules('required');
        $form->image('image', 'Photo')->uniqueName()->default('defaultAdmin.png')->rules('required');
        $form->text('nid', 'NID')->rules('required');
        $form->text('driverid', 'Driver ID')->rules('required');
        // change upload path ->move('/storage/images/Driver/')
        $form->image('licensepic', 'License Photo')->uniqueName()->rules('required');
        // use a unique name (md5(uniqid()).extension)
        //$form->image('licensepic')->uniqueName();
        //$form->image('licensepic', 'Licensepic');
        $form->text('license', 'License')->rules('required');
        $form->text('contactno', 'Contact No')->rules('required');
        $form->text('busno', 'Bus No')->rules('required');
        $form->textarea('address', 'Address')->rules('required');
        $form->radio('gender', 'Gender')->options([0 => 'Male', 1 => 'Female'])->stacked()->rules('required');

        return $form;
    }
}
