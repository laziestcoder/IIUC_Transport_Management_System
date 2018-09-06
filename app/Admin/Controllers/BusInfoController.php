<?php

namespace App\Admin\Controllers;

use App\BusInfo;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

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
        $grid = new Grid(new BusInfo);

        $grid->id('Id');
        $grid->busid('Busid');
        $grid->registration('Registration');
        $grid->license('License');
        $grid->seat('Seat');
        $grid->availability('Availability');
        $grid->user_id('User id');
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
        $show = new Show(BusInfo::findOrFail($id));

        $show->id('Id');
        $show->busid('Busid');
        $show->registration('Registration');
        $show->license('License');
        $show->seat('Seat');
        $show->availability('Availability');
        $show->user_id('User id');
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
        $form = new Form(new BusInfo);

        $form->text('busid', 'Busid');
        $form->text('registration', 'Registration');
        $form->text('license', 'License');
        $form->number('seat', 'Seat');
        $form->switch('availability', 'Availability')->default(1);
        $form->number('user_id', 'User id');

        return $form;
    }
}
