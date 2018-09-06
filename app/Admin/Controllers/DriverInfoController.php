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
     * @param mixed   $id
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
     * @param mixed   $id
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

        $grid->id('Id');
        $grid->name('Name');
        $grid->nid('Nid');
        $grid->driverid('Driverid');
        $grid->licensepic('Licensepic');
        $grid->license('License');
        $grid->contactno('Contactno');
        $grid->busno('Busno');
        $grid->address('Address');
        $grid->gender('Gender');
        $grid->image('Image');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Driver::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->nid('Nid');
        $show->driverid('Driverid');
        $show->licensepic('Licensepic');
        $show->license('License');
        $show->contactno('Contactno');
        $show->busno('Busno');
        $show->address('Address');
        $show->gender('Gender');
        $show->image('Image');
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
        $form = new Form(new Driver);

        $form->text('name', 'Name');
        $form->text('nid', 'Nid');
        $form->text('driverid', 'Driverid');
        $form->image('licensepic', 'Licensepic');
        $form->text('license', 'License');
        $form->text('contactno', 'Contactno');
        $form->text('busno', 'Busno');
        $form->textarea('address', 'Address');
        $form->radio('gender', 'Gender')->options([0 => 'Male', 1 => 'Female'])->stacked();
        $form->image('image', 'Image')->default('defaultAdmin.png');

        return $form;
    }
}
