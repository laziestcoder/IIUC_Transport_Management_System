<?php

namespace App\Admin\Controllers;

use App\AdminDashboard;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;


class AdminDashboardController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content
            ->header('Admin Dashboard')
            ->description('This is admin Dashboard')
            ->body($this->grid());
    }

    protected function grid()
    {
        $grid = new Grid(new AdminDashboard);
        $grid->setTitle('Schedule Dashborad');

        $states = [
            'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 2, 'text' => 'NO', 'color' => 'danger'],
        ];
        $grid->special_schedule('Special Schedule')->switch($states);
        $grid->regular_schedule('Regular Schedule')->switch($states);
        $grid->holiday('Holiday')->switch($states);
        $grid->schedule_suspend('Schedule Suspend')->switch($states);
        $grid->schedule_edit('Schedule Edit')->switch($states);
        $grid->disableActions();
        $grid->disableRowSelector();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->disablePagination();
        $grid->disableCreateButton();

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new AdminDashboard);

        $form->switch('special_schedule', 'Special schedule');
        $form->switch('regular_schedule', 'Regular schedule');
        $form->switch('holiday', 'Holiday');
        $form->switch('schedule_suspend', 'Schedule suspend');
        $form->switch('schedule_edit', 'Schedule edit');

        return $form;
    }
}
