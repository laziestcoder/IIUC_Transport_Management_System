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


class RoutesController extends Controller
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
            ->header('Bus Route')
            ->description('Here you will get all the bus route.')
            ->body($this->grid())
            ->body($this->grid2());
//            ->row('
//                <script>
//                function printInfo(ele)
//                {
//
//                  var openWindow = window.open("", "title", "attributes");
//                //openWindow.document.write(\'<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">\');
//                openWindow.document.write(ele.innerHTML);
//                openWindow.document.close();
//                openWindow.focus();
//                openWindow.print();
//                openWindow.close();
//                }
//                function print() {
//                     var prtContent = document.getElementById("print-me");
//                    var WinPrint = window.open(\'\', \'\', \'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0\');
//                    WinPrint.document.write(prtContent.innerHTML);
//                    WinPrint.document.close();
//                    WinPrint.focus();
//                    WinPrint.print();
//                    WinPrint.close();
//                }
//                </script></div>');
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
        $grid = new Grid(new BusRoute);

        $grid->id('ID')->sortable();
        $grid->routename('Route Name')->badge('green')->sortable();
        $grid->user_id('Inputed By')->display(function ($s) {
            return Administrator::all()->find($s)->name?: 'n/a';
        })->badge('blue')->sortable();
        $grid->created_at('Created At')->sortable();
        $grid->updated_at('Updated At')->sortable();
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
        $show = new Show(BusRoute::findOrFail($id));

        $show->id('ID');
        $show->routename('Route Name');
        $show->user_id('Created By')->as(function ($s) {
            return Administrator::all()->find($s)->name;
        })->label('primary');
        $show->created_at('Created At');
        $show->updated_at('Updated At');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BusRoute);

        $form->text('routename', 'Route Name')->label('green');
        $form->hidden('user_id', 'Created By')->default(function () {
            return Admin::user()->id;
        });

        return $form;
    }

    protected function grid2()
    {
        $grid = new Grid(new BusRoute);
        $grid->model()->orderBy("routename", "asc")->where('routename', '!=', 'All Route');
        $grid->setTitle('Route and Bus Stop Point Direction');


        $grid->routename('Route Name');
        $grid->id('Bus Stop Point')->display(function ($s) {
            $points = BusPoint::where('routeid', $s)->orderBy('weight', 'asc')->get();
            $s = "";
            $flag = count($points) - 1;
            if (count($points) > 0) {
                foreach ($points as $point) {
                    $s = $s . " " . $point->pointname;
                    if ($flag) {
                        $s = $s . " ==> ";
                        $flag--;
                    }
                }
            } else {
                $s = "< No Bus Stop Point Found >";
            }

            return $s;

        });

        $grid->disableRowSelector();
        //$grid->disableTools();
        $grid->disableFilter();
        $grid->disableCreateButton();
        $grid->disablePagination();
        $grid->disableActions();
        $grid->disableExport();
        $grid->tools(function ($tools) {
            $tools->disableRefreshButton();
        });
        return $grid;
    }
}
