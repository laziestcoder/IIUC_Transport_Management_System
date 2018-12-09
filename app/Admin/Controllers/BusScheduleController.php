<?php

namespace App\Admin\Controllers;

use App\BusRoute;
use App\Schedule;
use App\Day;
use App\Time;
use App\UserRole;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Database\Administrator;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


class BusScheduleController extends Controller
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
            ->header('Schedule')
            ->description('All Schedules')
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
            ->description('Create New Bus Schedule')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Schedule);

        $grid->id('ID')->sortable();
        $grid->day('Day')->display(function ($s) {
           if($s) {
                $s = Day::all()->find($s);
                if ($s) {
                    return $s->dayname;
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }
        })->badge('green')->sortable();
        $states = [
            'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'NO', 'color' => 'danger'],
        ];
//        $grid->confirmed(trans('Activated'))->switch($states)->sortable();
        $grid->toiiuc('To IIUC Capmus')->switch($states)->sortable();
        $grid->fromiiuc('From IIUC Campus')->switch($states)->sortable();
        $grid->male('Male')->switch($states)->sortable();
        $grid->female('Female')->switch($states)->sortable();
        $grid->time('Time')
            ->options()
            ->select(Time::all()->sortBy('time')->pluck('time','id'))
//            ->display(function ($s) {
//             if($s) {
//                $s = Time::all()->find($s);
//                if ($s) {
//                    return Carbon::parse($s->time)->format("g:i A");
//                } else {
//                    return 'n/a';
//                }
//            }else{
//                return 'Not Selected';
//            }})
            ->sortable();
        $grid->bususer('Bus For')->display(function ($s) {
            if($s) {
                $s = UserRole::all()->find($s);
                if ($s) {
                    return $s->name;
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }
        })->badge('orange')->sortable();
        $grid->route('Route')
            ->display(function ($s) {
            if($s) {
                $s = BusRoute::all()->find($s);
                if ($s) {
                    return $s->routename;
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }})
            ->badge('purple')->sortable();
        $grid->user_id('Inputed By')->display(function ($s) {
            if($s) {
                $s = Administrator::all()->find($s);
                if ($s) {
                    return $s->name;
                } else {
                    return 'n/a';
                }
            }else{
                return 'Not Selected';
            }
        })->badge('blue')->sortable();
        //$grid->created_at('Created At');
        $grid->updated_at('Last Updated');
        $grid->disableFilter();
        $grid->paginate(25);
        $grid->perPages([25, 50, 100, 200, 300]);

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
        $show = new Show(Schedule::findOrFail($id));

        $show->id('ID');
        $show->day('Day')->as(function ($s) {
            return Day::all()->find($s)->dayname;
        });
        $show->toiiuc('To IIUC Campus')->as(function ($s) {
            return $s ? 'Yes' : 'No';
        });
        $show->fromiiuc('From IIUC Campus')->as(function ($s) {
            return $s ? 'Yes' : 'No';
        });
        $show->male('Male')->as(function ($s) {
            return $s ? 'Yes' : 'No';
        });
        $show->female('Female')->as(function ($s) {
            return $s ? 'Yes' : 'No';
        });
        $show->time('Time')->as(function ($s) {
            return Carbon::parse(Time::all()->find($s)->time)->format("g:i A");
        });
        $show->bususer('Bus For')->as(function ($s) {
            return UserRole::all()->find($s)->name;
        });
        $show->route('Route')->as(function ($s) {
            return BusRoute::all()->find($s)->routename;
        });
        $show->user_id('Inputed By')->as(function ($s) {
            return Administrator::all()->find($s)->name;
        });
        $show->created_at('Created At');
        $show->updated_at('Updated At');
        $show->panel()->title('Details');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Schedule);

        $form->select('day', 'Day')
            ->options(Day::all()->pluck('dayname','id'))
            ->rules('required');
        $states = [
            'on'  => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'NO', 'color' => 'danger'],
        ];

        $form->switch('toiiuc', 'To IIUC Campus')->states($states);
        $form->switch('fromiiuc', 'From IIUC Campus')->states($states);
        $form->switch('male', 'Male')->states($states);
        $form->switch('female', 'Female')->states($states);
        $form->select('time', 'Time')
            ->options(Time::all()->sortBy('time')->pluck('time','id'))
            ->rules('required');
        $form->select('bususer', 'Bus For')
            ->options(UserRole::all()->sortBy('name')->pluck('name','id'))
            ->rules('required');
        $form->select('route', 'Route')
            ->options(BusRoute::all()->sortBy('routename')->pluck('routename','id'))
            ->rules('required');
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });

        return $form;
    }
}
