<?php

namespace App\Admin\Controllers;

use App\Schedule;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


class BusScheduleController extends Controller
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
            ->header('Schedule')
            ->description('All Schedules')
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
        $grid = new Grid(new Schedule);

        $grid->id('Id');
        $grid->day('Day');
        $grid->toiiuc('Toiiuc');
        $grid->fromiiuc('Fromiiuc');
        $grid->male('Male');
        $grid->female('Female');
        $grid->time('Time');
        $grid->user('User');
        $grid->route('Route');
        $grid->user_id('User id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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
        $show = new Show(Schedule::findOrFail($id));

        $show->id('Id');
        $show->day('Day');
        $show->toiiuc('Toiiuc');
        $show->fromiiuc('Fromiiuc');
        $show->male('Male');
        $show->female('Female');
        $show->time('Time');
        $show->user('User');
        $show->route('Route');
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
        $form = new Form(new Schedule);

        $form->number('day', 'Day');
        $form->switch('toiiuc', 'Toiiuc');
        $form->switch('fromiiuc', 'Fromiiuc');
        $form->switch('male', 'Male');
        $form->switch('female', 'Female');
        $form->number('time', 'Time');
        $form->number('user', 'User')->default(1);
        $form->number('route', 'Route');
        $form->number('user_id', 'User id');

        return $form;
    }
}
