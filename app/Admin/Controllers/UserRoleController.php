<?php

namespace App\Admin\Controllers;

use App\UserRole;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserRoleController extends Controller
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
            ->header('User Role')
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
        $grid = new Grid(new UserRole);

        $grid->id('ID');
        $grid->name('Role Name');
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() <= 3) {
                $actions->disableDelete();
            }
            //$actions->disableEdit();
            //$actions->disableview();
        });
        $grid->disableFilter();
//        $grid->disableActions();
        $grid->disableRowSelector();
//        $grid->disableCreateButton();

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
        $show = new Show(UserRole::findOrFail($id));
        $show->panel()->title('View');

        $show->id('ID');
        $show->name('Role Name');
        $show->created_at('Created At');
        $show->updated_at('Updated At');
//        $show->actions(function (Grid\Displayers\Actions $actions) {
//            if ($actions->getKey() <= 3) {
//                $actions->disableDelete();
//            }
//            //$actions->disableEdit();
//            $actions->disableview();
//        });
        $show->panel()
            ->tools(function ($tools) {
                //$tools->disableEdit();
                //$tools->disableList();
                $tools->disableDelete();
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
        $form = new Form(new UserRole);

        $form->text('name', 'Role Name');
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();

            // Disable back btn.
            //$tools->disableBackButton();

            // Disable list btn
            //$tools->disableListButton();

            // Add a button, the argument can be a string, or an instance of the object that implements the Renderable or Htmlable interface
            //$tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });

        return $form;
    }
}
