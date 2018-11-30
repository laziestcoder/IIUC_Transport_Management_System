<?php

namespace App\Admin\Controllers;

use App\StudentSchedule;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\User;
use App\Day;
use App\Time;
use App\BusPoint;
use App\UserRole;

class BusRouteStudentInfoController extends Controller
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
            ->header('Bus Student Route')
            ->description('All Student Information')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new StudentSchedule);
        $grid->model()->where('pickpoint', '!=', false);

        $grid->id('ID')->sortable();
        $grid->userrole('User')->display(function($id) {
            if($id) {
                return UserRole::find($id)->name;
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->user_id('Varsity ID')->display(function($id) {
            return User::find($id)->jobid;
        })->sortable();
        $grid->day('Day')->display(function($id) {
            return Day::find($id)->dayname;
        })->sortable();
        $grid->pickpoint('Pickpoint')->display(function($id) {
            if($id) {
                return BusPoint::find($id)->pointname;
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->picktime('Picktime')->display(function($id) {
            if($id) {
            return Carbon::parse(Time::find($id)->time)->format('g:i A');
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->droppoint('Droppoint')->display(function($id) {
            if($id) {
            return BusPoint::find($id)->pointname;
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->droptime('Droptime')->display(function($id) {
            if($id) {
            return Carbon::parse(Time::find($id)->time)->format('g:i A');
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->entrydate('Entrydate');
        $grid->created_at('Created at')->display(function($id) {
            return Carbon::parse($id)->format('Y-m-d g:i:s A');
        });
        $grid->updated_at('Updated at')->display(function($id) {
            return Carbon::parse($id)->format('Y-m-d g:i:s A');
        });
        $grid->disableCreateButton();
        $grid->disableActions();
        $grid->disableRowSelector();
//        $grid->actions(function (Grid\Displayers\Actions $actions) {
//            $actions->disableDelete();
//            $actions->disableEdit();
//            $actions->disableview();
//
//            // prepend an action.
//            //$actions->prepend('<a href=""><i class="fa fa-eye"></i></a>');
//
//            // append an action.
//            //$actions->append('N/A');
//
//        });

//        $grid->tools(function (Grid\Tools $tools) {
//            $tools->batch(function (Grid\Tools\BatchActions $actions) {
//                $actions->disableDelete();
//            });
//        });



        return $grid;
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
//    public function show($id, Content $content)
//    {
//        return $content
//            ->header('Detail')
//            ->description('description')
//            ->body($this->detail($id));
//    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
//    public function edit($id, Content $content)
//    {
//        return $content
//            ->header('Edit')
//            ->description('description')
//            ->body($this->form()->edit($id));
//    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
//    public function create(Content $content)
//    {
//        return $content
//            ->header('Create')
//            ->description('description')
//            ->body($this->form());
//    }



    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
//    protected function detail($id)
//    {
//        $show = new Show(StudentSchedule::findOrFail($id));
//
//        $show->id('Id');
//        $show->day('Day');
//        $show->pickpoint('Pickpoint');
//        $show->picktime('Picktime');
//        $show->droppoint('Droppoint');
//        $show->droptime('Droptime');
//        $show->user_id('User id');
//        $show->entrydate('Entrydate');
//        $show->created_at('Created at');
//        $show->updated_at('Updated at');
//
//        return $show;
//    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
//    protected function form()
//    {
//        $form = new Form(new StudentSchedule);
//
//        $form->number('day', 'Day');
//        $form->number('pickpoint', 'Pickpoint');
//        $form->number('picktime', 'Picktime');
//        $form->number('droppoint', 'Droppoint');
//        $form->number('droptime', 'Droptime');
//        $form->number('user_id', 'User id');
//        $form->date('entrydate', 'Entrydate')->default(date('Y-m-d'));
//
//        return $form;
//    }
}
