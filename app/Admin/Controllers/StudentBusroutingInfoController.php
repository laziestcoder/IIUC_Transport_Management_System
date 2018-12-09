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

class StudentBusroutingInfoController extends Controller
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
            ->header('Student Bus Route Per Day')
            ->description('Students individual route information. Students Pick Up Point and Time and Drop Point and Time per day.')
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
                $id = UserRole::find($id);
                if ($id) {
                    return $id->name;
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->user_id('Varsity ID')->display(function($id) {
            $id = User::find($id);
            if ($id) {
                return $id->jobid;
            } else {
                return 'n/a';
            }
        })->sortable();
        $grid->day('Day')->display(function($id) {

            $id = Day::find($id);
            if ($id) {
                return $id->dayname;
            } else {
                return 'n/a';
            }
        })->sortable();
        $grid->pickpoint('Pick Point')->display(function($id) {
            if($id) {

                $id = BusPoint::find($id);
                if ($id) {
                    return $id->pointname;
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->picktime('Pick Time')->display(function($id) {
            if($id) {
                $id = Time::find($id);
                if ($id) {
                    return Carbon::parse($id->time)->format('g:i A');
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->droppoint('Drop Point')->display(function($id) {
            if($id) {
                $id = BusPoint::find($id);
                if ($id) {
                    return $id->pointname;
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->droptime('Drop Time')->display(function($id) {
            if($id) {
                $id = Time::find($id);
                if ($id) {
                    return Carbon::parse($id->time)->format('g:i A');
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }
        })->sortable();
        $grid->entrydate('Entry Date');
        $grid->created_at('Created At')->display(function($s) {
            if ($s) {
                return Carbon::parse($s)->format('Y-m-d g:i:s A');
            } else {
                return 'n/a';
            }
        });
        $grid->updated_at('Updated At')->display(function($s) {
            if ($s) {
                return Carbon::parse($s)->format('Y-m-d g:i:s A');
            } else {
                return 'n/a';
            }
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
