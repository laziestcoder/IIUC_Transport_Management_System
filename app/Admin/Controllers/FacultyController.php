<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

use App\User;
use DB;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Show;

class FacultyController extends Controller
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
            ->description(trans('Faculty List'))
            ->body($this->grid()->render());
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return User::grid(function (Grid $grid) {

            $grid->model()->where('userrole', '=', 2);
            $grid->id('ID')->sortable();
            $grid->jobid(trans('Varsity ID'))->sortable();;
            $grid->image(trans('admin.avatar'))->display(function ($s) {
                $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg";
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                // Get URL content
                $lines_string = curl_exec($ch);
                $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                // close handle to release resources
                curl_close($ch);
                //output, you can also save it locally on the server
                $file2 = $lines_string;
                $file = $retcode;

                if ($file == 200 && $file2[0] != '<') {
                    return "<img style='max-height:100px; max-width:100px;' src='http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg' alt='" . $this->name . "'/>";
                } else {
                    return "<img style='max-height:100px; max-width:100px;' src='/storage/image/user/" . $this->image . "' alt='" . $this->name . "'/>";
                }
            });
            $grid->name(trans('Name'));
            $grid->email(trans('Email'));
            $grid->gender(trans('Gender'))->display(function ($s) {
                return $s ? 'Female' : 'Male';
            });

            $grid->confirmed(trans('Activated'))->display(function ($s) {
                return $s ? 'Yes' : 'No';
            });
            $grid->confirmation(trans('Verified'))->display(function ($s) {
                return $s ? 'Yes' : 'No';
            });
            $grid->created_at(trans('Member Since'));
            $grid->updated_at(trans('Last Updated'));

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if ($actions->getKey() == 1) {
                    $actions->disableDelete();
                }
//                $actions->disableEdit();
                $actions->disableview();
            });

            $grid->tools(function (Grid\Tools $tools) {
                $tools->batch(function (Grid\Tools\BatchActions $actions) {
                    $actions->disableDelete();
                });
            });
            $grid->filter(function ($filter) {
                // Sets the range query for the created_at field
                $filter->between('jobid', 'Search by Varsity ID');
            });

            $grid->disableCreateButton();
            $grid->perPages([10, 15, 20, 25, 30, 35, 40, 45, 50, 100]);


        });
    }


    /**
     *  protected function grid()
    {
    $grid = new Grid(new Administrator());

    $grid->id('ID')->sortable();
    $grid->username(trans('admin.username'));
    $grid->name(trans('admin.name'));
    $grid->roles(trans('admin.roles'))->pluck('name')->label();
    $grid->created_at(trans('admin.created_at'));
    $grid->updated_at(trans('admin.updated_at'));

    $grid->actions(function (Grid\Displayers\Actions $actions) {
    if ($actions->getKey() == 1) {
    $actions->disableDelete();
    }
    });

    $grid->tools(function (Grid\Tools $tools) {
    $tools->batch(function (Grid\Tools\BatchActions $actions) {
    $actions->disableDelete();
    });
    });

    return $grid;
    }
     */
    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
//    public function show($id, Content $content)
//    {
//        return $content
//            ->header(trans('User'))
//            ->description(trans('Details'))
//            ->body($this->detail($id));
//    }


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
        $form = new Form(new User());

        $form->display('id', 'ID');
        $form->display('jobid', 'Varsity ID');
        $form->display('avatar', trans('admin.avatar'))->with(function ($s){
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
                return "<img style='max-height:100px; max-width:100px;' src='http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg' alt='" . $this->name . "'/>";
            } else {
                return "<img style='max-height:100px; max-width:100px;' src='/storage/image/user/" . $this->image . "' alt='" . $this->name . "'/>";
            }
        });
        $form->display('name', trans('admin.name'))->rules('required');
        $form->display('email', trans('Email'))->rules('required');
        $form->display('gender',trans('Gender'))->with(function ($s){
            return $s? 'Female':'Male';
        });
        $form->display('confirmed', trans('Activated'))->with(function ($s){
            return $s? 'Yes':'No';
        });

        $form->radio('confirmation', 'Verified')->options([0 => 'No', 1 => 'Yes'])->stacked();
        $form->display('created_at', trans('Member Since'));
        $form->display('updated_at', trans('Last Updated'));
        $form->save();

        return $form;
    }


//    protected function imageValidate($pic){
//        $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $pic . ".jpg";
//        $ch = curl_init();
//        $timeout = 5;
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//
//        $lines_string = curl_exec($ch);
//        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        curl_close($ch);
//        $file2 = $lines_string;
//        $file = $retcode;
//        if ($file == 200 && $file2[0] != '<') {
//            return true;
//        } else {
//            return false;
//        }
//    }
}
