<?php

namespace App\Admin\Controllers;

use App\BusPoint;
use App\BusRoute;
use Encore\Admin\Auth\Database\Administrator;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;


class PointsController extends Controller
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
            ->header('Bus Stop Point')
            ->description('Here you will get all the bus stop point.')
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
            ->description('See detail')
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
            ->description('Edit information')
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
            ->description('Create new bus stop point')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BusPoint);

        //$grid->id('ID')->sortable();
        $grid->routeid('Route Name')->display(function ($s) {
            return BusRoute::all()->find($s)->routename;
        })->badge('green')->sortable();
        $grid->pointname('Point Name')->sortable();
        $grid->weight('Sequence')->editable();
        $grid->user_id('Inputed By')->display(function ($s) {
            return Administrator::all()->find($s)->name;
        })->badge('blue')->sortable();
        $grid->created_at('Created At');
       // $grid->updated_at('Updated At');


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
        $show = new Show(BusPoint::findOrFail($id));

        $show->id('ID');
        $show->pointname('Point Name');
        $show->routeid('Route Name')->as(function ($s) {
            return BusRoute::all()->find($s)->routename;
        })->label();
        $show->user_id('Created By')->as(function ($s) {
            return Administrator::all()->find($s)->name;
        })->label('primary');
        $show->created_at('Created At');
        $show->updated_at('Updated At');
        $show->weight('Sequence');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BusPoint);

        $form->text('pointname', 'Point Name');
        $form->select('routeid', 'Route Name')
            ->options(BusRoute::all()->pluck('routename', 'id'))
            ->rules('required');
        $form->number('weight', 'Sequence')->rules('required');
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });


        return $form;
    }
}
