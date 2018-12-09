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
            ->header('Per Route Bus and Student Number')
            ->description('Here Per Route Per Point wise route and student number details can be seen.')
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
//    public function edit($id, Content $content)
//    {
//        return $content
//            ->header('Edit')
//            ->description('description')
//            ->body($this->form()->edit($id));
//    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
//    public function create(Content $content)
//    {
//        return $content
//            ->header('Create')
//            ->description('description')
//            ->body($this->form());
//    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BusStudentInfo);

        $grid->id('ID')->sortable();
        $grid->routeid('Route ID')->sortable();
        $grid->pointid('Point ID')->sortable();
        $grid->studentno('Student No')->sortable();
        $grid->dayid('Day ID')->sortable();
        $grid->timeid('Time ID')->sortable();
        $grid->gender('Gender')->sortable();
        $grid->paginate('25');
        $grid->perPages([25,50,100]);


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

        $show->id('ID');
        $show->routeid('Route ID');
        $show->pointid('Point ID');
        $show->studentno('Student No');
        $show->dayid('Day ID');
        $show->timeid('Time ID');
        $show->gender('Gender');


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
//    protected function form()
//    {
//        $form = new Form(new BusStudentInfo);
//
//        $form->number('routeid', 'Routeid');
//        $form->number('pointid', 'Pointid');
//        $form->number('studentno', 'Studentno');
//        $form->number('dayid', 'Dayid');
//        $form->number('timeid', 'Timeid');
//        $form->switch('gender', 'Gender');
//
//        return $form;
//    }
}
