<?php

namespace App\Admin\Controllers;

use App\BusStudentInfo;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BusStudentInfoController extends Controller
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
            ->header('Index')
            ->description('description')
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
            ->description('description')
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
        $grid = new Grid(new BusStudentInfo);

        $grid->id('Id');
        $grid->routeid('Routeid');
        $grid->pointid('Pointid');
        $grid->studentno('Studentno');
        $grid->dayid('Dayid');
        $grid->timeid('Timeid');
        $grid->gender('Gender');
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
        $show = new Show(BusStudentInfo::findOrFail($id));

        $show->id('Id');
        $show->routeid('Routeid');
        $show->pointid('Pointid');
        $show->studentno('Studentno');
        $show->dayid('Dayid');
        $show->timeid('Timeid');
        $show->gender('Gender');
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
        $form = new Form(new BusStudentInfo);

        $form->number('routeid', 'Routeid');
        $form->number('pointid', 'Pointid');
        $form->number('studentno', 'Studentno');
        $form->number('dayid', 'Dayid');
        $form->number('timeid', 'Timeid');
        $form->switch('gender', 'Gender');

        return $form;
    }
}
