<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
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
            ->header('Other User')
            ->description(' ')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);
        $grid->model()->where('user_type', '>', 3)->orderBy('varsity_id', 'asc')->orderBy('created_at', 'asc');

        //$grid->id('ID')->sortable();
        $grid->varsity_id(trans('Varsity ID'))->sortable()->editable();
//            $grid->image(trans('admin.avatar'))->display(function ($s) use ($self) {
//                $file= $self->imageValidate($this->varsity_id);  //I want to use this $file value
//                if($file){ // here I want to access $file
//                    return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='http://upanel.iiuc.ac.bd:81/Picture/" . $this->varsity_id . ".jpg' alt='" . $this->name . "'/>";
//                } else {
//                    return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='/storage/image/user/" . $this->image . "' alt='" . $this->name . "'/>";
//                }
//            });
        $grid->name(trans('Name'))->sortable()->editable();
        $grid->email(trans('Email'))->sortable();
        $grid->gender(trans('Gender'))->display(function ($s) {
            return $s ? 'Female' : 'Male';
        })->sortable();
        $states = [
            'on' => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'NO', 'color' => 'danger'],
        ];
        $grid->confirmed(trans('Activated'))->switch($states)->sortable();
        $grid->confirmation(trans('Verified'))->switch($states)->sortable();
        // $grid->created_at(trans('Member Since'))->sortable();
        $grid->updated_at(trans('Last Updated'))->sortable();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() == 1) {
                // $actions->disableDelete();
            }
            $actions->disableEdit();
            //$actions->disableview();
        });


        // $grid->disableTools();
        //$grid->disableRowSelector();

        /*  $grid->tools(function (Grid\Tools $tools) {
              $tools->batch(function (Grid\Tools\BatchActions $actions) {
                  $actions->disableDelete();
              });
          });*/
        $grid->filter(function ($filter) {
            // Sets the range query for the created_at field
            $filter->disableIdFilter();
            $filter->like('varsity_id', 'Varsity ID');
        });

        $grid->disableCreateButton();
        $grid->perPages([25, 30, 35, 40, 45, 50, 100]);

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
            ->description(' ')
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
        $self = $this;
        $show = new Show(User::findOrFail($id));
        $show->panel()->title('View Profile');

        //$show->id('ID');
        $show->name('Name');
        $show->varsity_id(trans('Varsity ID'));
        $show->divider();
        $show->image(trans('admin.avatar'))
            ->as(function () use ($self) {
                $file = $self->imageValidate($this->varsity_id);  //I want to use this $file value
                if ($file) { // here I want to access $file
                    return "http://upanel.iiuc.ac.bd:81/Picture/" . $this->varsity_id . ".jpg";
                } else {
                    return "/image/user/" . $this->image;
                }
            })->image();

        $show->email(trans('Email'));
        $show->gender(trans('Gender'))->as(function ($s) {
            return $s ? 'Female' : 'Male';
        });

        $show->user_type(trans('Registered As'))->as(function ($s) {
            return UserType::find($s)->name;
        });

        $show->confirmed(trans('Activated'))->as(function ($s) {
            return $s ? 'YES' : 'NO';
        });
        $show->confirmation(trans('Verified'))->as(function ($s) {
            return $s ? 'YES' : 'NO';
        });


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
            ->description(' ')
            ->body($this->form()->edit($id));
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
        $form->text('varsity_id', 'Varsity ID');
        $form->password('password', 'Password');
        $form->select('user_type', 'Registered As')
            ->options(UserType::all()->sortBy('name')->pluck('name', 'id'))
            ->rules('required');
        $states = [
            'on' => ['value' => 1, 'text' => 'Female', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'Male', 'color' => 'danger'],
        ];
        $form->switch('gender', 'Gender')->states($states);
        $form->number('adminrole', 'Admin Role')->default(1);
        $states = [
            'on' => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $form->switch('confirmation', 'Verified')->states($states);
        //$form->text('remember_token', 'Remember token');
        $form->switch('confirmed', 'Activated')->states($states);
        //$form->text('confirmation_code', 'Confirmation code');

        $form->image('image', 'Image')->default('defaultAdmin.png');

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
            ->description(' ')
            ->body($this->form());
    }
}
