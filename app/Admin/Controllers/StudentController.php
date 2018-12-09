<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\User;
use DB;
use Encore\Admin\Controllers\HasResourceActions;


class StudentController extends Controller
{
    use HasResourceActions;
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
           ->header(trans('Users'))
            ->description(trans('Student List'))
            ->body($this->grid(1)->render());
    }




    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function grid($value)
    {
        $self = $this;
        return User::grid(function (Grid $grid) use ($value,$self) {


            $grid->model()->where('userrole', '=', $value)->orderBy('jobid', 'asc')->orderBy('created_at', 'asc');
            $grid->id('ID')->sortable();
            $grid->jobid(trans('Varsity ID'))->sortable()->editable();
//            $grid->image(trans('admin.avatar'))->display(function ($s) use ($self) {
//                $file= $self->imageValidate($this->jobid);  //I want to use this $file value
//                if($file){ // here I want to access $file
//                    return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg' alt='" . $this->name . "'/>";
//                } else {
//                    return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='/storage/image/user/" . $this->image . "' alt='" . $this->name . "'/>";
//                }
//            });
            $grid->name(trans('Name'))->sortable()->editable();
            $grid->email(trans('Email'));
            $grid->gender(trans('Gender'))->display(function ($s) {
                return $s ? 'Female' : 'Male';
            });
            $states = [
                'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'NO', 'color' => 'danger'],
            ];
            $grid->confirmed(trans('Activated'))->switch($states)->sortable();
            $grid->confirmation(trans('Verified'))->switch($states)->sortable();
            $grid->created_at(trans('Member Since'));
            $grid->updated_at(trans('Last Updated'));

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
                $filter->like('jobid', 'Varsity ID');
            });

            $grid->disableCreateButton();
            $grid->perPages([25, 30, 35, 40, 45, 50, 100]);


        });
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('')
            ->body($this->detail($id));
    }

    public function detail($id)
    {
        $self = $this;
        $show = new Show(User::findOrFail($id));
        $show->panel()->title('View Profile');

        //$show->id('ID');
        $show->name('Name');
        $show->jobid(trans('Varsity ID'));
        $show->divider();
        $show->image(trans('admin.avatar'))
            ->as(function () use ($self) {
                $file= $self->imageValidate($this->jobid);  //I want to use this $file value
                if($file){ // here I want to access $file
                    return "http://upanel.iiuc.ac.bd:81/Picture/".$this->jobid.".jpg";
                } else {
                    return "/image/user/".$this->image;
                }
            })->image();

        $show->email(trans('Email'));
        $show->gender(trans('Gender'))->as(function ($s) {
            return $s ? 'Female' : 'Male';
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
     * @param $id
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('User'))
            ->description(trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $self = $this;
        $form = new Form(new User);

       // $form->display('id', 'ID');
        $form->text('jobid', 'Varsity ID');
        $form->display('avatar', trans('admin.avatar'))->with(function ($s) use ($self){
            $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg";
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

            $lines_string = curl_exec($ch);
            $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $file2 = $lines_string;
            $file = $retcode;
            if ($file == 200 && $file2[0] != '<') {
//            $file = $self->imageValidate($this->jobid);
//            if($file){
                return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg' alt='" . $this->name . "'/>";
            } else {
                return "<img style='max-width:100px;max-height:100px' class='img img-thumbnail' src='/storage/image/user/" . $this->image . "' alt='" . $this->name . "'/>";
            }
        });
        $form->text('name', trans('admin.name'))->rules('required');
        $form->display('email', trans('Email'))->rules('required');
        $form->display('gender',trans('Gender'))->with(function ($s){
            return $s? 'Female':'Male';
        });
//        $form->display('confirmed', trans('Activated'))->with(function ($s){
//            return $s ? "<span class='label label-success'>Yes</span>" : "<span class='label label-danger'>No</span>";
//        });
        $states = [
            'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
        ];
        $form->switch('confirmed','Activated')->states($states);
        $form->switch('confirmation','Verified')->states($states);

        //$form->radio('confirmation', 'Verified')->options([0 => 'No', 1 => 'Yes'])->stacked();
        $form->display('created_at', trans('Member Since'));
        $form->display('updated_at', trans('Last Updated'));
        $form->tools(function (Form\Tools $tools) {
            // Add a button, the argument can be a string, or an instance of the object that implements the Renderable or Htmlable interface
            //$tools->append('<a onclick="window.history.back()" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>');
            // Disable list btn
            //$tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
        });

        //$form->save();

        return $form;
    }


    public function imageValidate($pic){
        $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $pic . ".jpg";
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $lines_string = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $file2 = $lines_string;
        $file = $retcode;
        if ($file == 200 && $file2[0] != '<') {
            return true;
        } else {
            return false;
        }
    }
}
