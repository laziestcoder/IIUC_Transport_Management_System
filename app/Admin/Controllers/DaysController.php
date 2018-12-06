<?php

namespace App\Admin\Controllers;

use App\Day;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;



class DaysController extends Controller
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
            ->header('Day')
            ->description('')
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
        $grid = new Grid(new Day);

        $grid->id('ID');
        $grid->dayname('Day')->badge('green');
        $states = [
            'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 2, 'text' => 'NO', 'color' => 'danger'],
        ];
        $grid->active(trans('Active'))->switch($states);
        $grid->user_id('Created By')->display(function ($s) {
            if($s) {
                return Administrator::all()->find($s)->name?: 'n/a';
            }else{
            return 'Default';
            }
        })->badge('blue')->sortable();
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() <= 8) {
                $actions->disableDelete();
                $actions->disableEdit();
            }
            //$actions->disableEdit();
            //$actions->disableview();
        });
        $grid->disableRowSelector();
        $grid->disableFilter();

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
        $show = new Show(Day::findOrFail($id));

        $show->id('ID');
        $show->dayname('Day');
        $show->active(trans('Active'))->as(function ($s) {
            return $s ? 'YES' : 'NO';
        });
        $show->user_id('Created By')->as(function ($s) {
            return Administrator::all()->find($s)->name;
        })->label('primary');
        $show->created_at('Created At');
        $show->updated_at('Updated At');


        $show->panel()
            ->tools(function ($tools) use ($id) {
                if( $id <= 8) {
                    $tools->disableEdit();
                    //$tools->disableList();
                    $tools->disableDelete();
                }
            });


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Day);

        $form->text('dayname', 'Day');
        $states = [
            'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $form->switch('active','Active')->states($states);
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });

        return $form;
    }
}
