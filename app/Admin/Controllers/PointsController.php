<?php

namespace App\Admin\Controllers;

use App\BusPoint;
use App\BusRoute;
use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


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
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BusPoint);
        $grid->model()->orderBy('routeid', 'asc')->orderBy('weight', 'asc');

        //$grid->id('ID')->sortable();
        $grid->pointname('Point Name')->badge('purple')->sortable();
        $grid->weight('Sequence')->editable();
        $grid->routeid('Route Name')->display(function ($s) {
            $sd = BusRoute::all()->find($s);
            if ($sd) {
                return $sd->routename;
            } else {
                return 'n/a';
            }
        })->badge('green')->sortable();

        $states = [
            'on' => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'NO', 'color' => 'danger'],
        ];
        $grid->active('Published')->switch($states)->sortable();
        $grid->user_id('Inputed By')->display(function ($s) {
            $s = Administrator::all()->find($s);
            if ($s) {
                return $s->name;
            } else {
                return 'n/a';
            }
        })->badge('blue')->sortable();
        // $grid->orderable();
        $grid->created_at('Created At');
        // $grid->updated_at('Updated At');
        //$grid->disablePagination();
        //$grid->perPages([25, 50, 100, 150]);
        $grid->disablePagination();


        return $grid;
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
        $states = [
            'on' => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $form->switch('active', 'Published')->states($states);
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });


        return $form;
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
}
