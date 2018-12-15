<?php

namespace App\Admin\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OtherUsersController extends Controller
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
     * @param mixed $id
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
     * @param mixed $id
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
        $grid = new Grid(new User);

        $grid->id('Id');
        $grid->name('Name');
        $grid->email('Email');
        $grid->jobid('Jobid');
        $grid->password('Password');
        $grid->userrole('Userrole');
        $grid->gender('Gender');
        $grid->adminrole('Adminrole');
        $grid->confirmation('Confirmation');
        $grid->remember_token('Remember token');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->confirmed('Confirmed');
        $grid->confirmation_code('Confirmation code');
        $grid->image('Image');

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
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->email('Email');
        $show->jobid('Jobid');
        $show->password('Password');
        $show->userrole('Userrole');
        $show->gender('Gender');
        $show->adminrole('Adminrole');
        $show->confirmation('Confirmation');
        $show->remember_token('Remember token');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->confirmed('Confirmed');
        $show->confirmation_code('Confirmation code');
        $show->image('Image');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', 'Name');
        $form->email('email', 'Email');
        $form->text('jobid', 'Jobid');
        $form->password('password', 'Password');
        $form->number('userrole', 'Userrole');
        $form->switch('gender', 'Gender');
        $form->number('adminrole', 'Adminrole')->default(1);
        $form->switch('confirmation', 'Confirmation');
        $form->text('remember_token', 'Remember token');
        $form->switch('confirmed', 'Confirmed');
        $form->text('confirmation_code', 'Confirmation code');
        $form->image('image', 'Image')->default('defaultAdmin.png');

        return $form;
    }
}
