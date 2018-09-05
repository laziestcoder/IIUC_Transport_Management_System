<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;


class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');
            $content->description('This is Super Admin Dashboard');
            $content->row("<style>
                                    .title {
                                        font-size: 50px;
                                        color: #636b6f;
                                        font-family: 'Raleway', sans-serif;
                                        font-weight: 100;
                                        display: block;
                                        text-align: center;
                                        margin: 20px 0 10px 0px;
                                    }
                                
                                    .links {
                                        text-align: center;
                                        margin-bottom: 20px;
                                    }
                                
                                    .links > a {
                                        color: #636b6f;
                                        padding: 0 25px;
                                        font-size: 12px;
                                        font-weight: 600;
                                        letter-spacing: .1rem;
                                        text-decoration: none;
                                        text-transform: uppercase;
                                    }
                                    </style>");
            $content->row("<div class='title'><i>Welcome to <b>ITMS</b> Admin Panel</i></div>");

            //$content->row(Dashboard::title());
            $content->row("<div class=\"links\"><a>Warmth wishes to Admin <i>" . Admin::user()->name . "</i></a></div>");
            if (DB::table('admin_role_users')->where('user_id', (Admin::user()->id))->first()->role_id == 1) {
                $content->row(function (Row $row) {

                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::environment());
                    });

                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::extensions());
                    });

                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::dependencies());
                    });
                });
            }
        });
    }

    public function StudentList()
    {
//        $students = User::where('userrole','1')->get();
//        $teachers = User::where('userrole','2')->get();
//        $officers = User::where('userrole','3')->get();
//
//        $data = array(
//            "header" => "ITMS User List",
//            "description" => "This is page is showing all user profile list of Students, Faculty Members and Officers/Staffs",
//            "students" => $students,
//            "teachers" => $teachers,
//            "officers" => $officers,
//
//        );
//        return view('user.students')->with($data);

        return Admin::content(function (Content $content) {
            $content->header(trans('Users'));
            $content->description(trans('Student List'));
            $content->body($this->StudentGrid()->render());
        });

    }

    public function FacultyList()
    {
        return Admin::content(function (Content $content) {
            $content->header(trans('Users'));
            $content->description(trans('Faculty List'));
            $content->body($this->FacultyGrid()->render());
        });

    }
    public function OfficerList()
    {
        return Admin::content(function (Content $content) {
            $content->header(trans('Users'));
            $content->description(trans('Officers and Staff List'));
            $content->body($this->OfficerGrid()->render());
        });

    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function StudentGrid()
    {
        return User::grid(function (Grid $grid) {

            $grid->model()->where('userrole', '=', 1);
            $grid->id('ID')->sortable();
            $grid->jobid(trans('Varsity ID'));
            $grid->image(trans('admin.avatar'))->display(function ($s) {
                $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid.".jpg";
//                $file = file($url);
//                $file = file_exists($url);
//                $file = file_get_contents($url);
//                $file = get_included_files($url);
//                $file = get_required_files($url);
//                $file = @get_headers($url);
//                $file = get_resources($url);


                $ch = curl_init();
                $timeout = 5;

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

                // Get URL content
                $lines_string = curl_exec($ch);
                // close handle to release resources
                curl_close($ch);
                //output, you can also save it locally on the server
                $file = $lines_string;
                if ($file[0] != '<') {
                    return "<img style='max-height:100px; max-width:100px;' src='http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg' alt='".$this->name."'/>";
                } else {
                    return "<img style='max-height:100px; max-width:100px;' src='/storage/image/user/" . $this->image . "' alt='".$this->name."'/>";
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
            $grid->perPages([10, 25, 20, 25, 30, 35, 40, 45, 50, 100]);


        });
    }
    protected function FacultyGrid()
    {
        return User::grid(function (Grid $grid) {

            $grid->model()->where('userrole', '=', 2);
            $grid->id('ID')->sortable();
            $grid->jobid(trans('Varsity ID'));
            $grid->image(trans('admin.avatar'))->display(function ($s) {
                $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid.".jpg";
//                $file = file($url);
//                $file = file_exists($url);
//                $file = file_get_contents($url);
//                $file = get_included_files($url);
//                $file = get_required_files($url);
//                $file = @get_headers($url);
//                $file = get_resources($url);


                $ch = curl_init();
                $timeout = 5;

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

                // Get URL content
                $lines_string = curl_exec($ch);
                // close handle to release resources
                curl_close($ch);
                //output, you can also save it locally on the server
                $file = $lines_string;
                if ($file[0] != '<') {
                    return "<img style='max-height:100px; max-width:100px;' src='http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg' alt='".$this->name."'/>";
                } else {
                    return "<img style='max-height:100px; max-width:100px;' src='/storage/image/user/" . $this->image . "' alt='".$this->name."'/>";
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
            $grid->perPages([10, 25, 20, 25, 30, 35, 40, 45, 50, 100]);


        });
    }
    protected function OfficerGrid()
    {
        return User::grid(function (Grid $grid) {

            $grid->model()->where('userrole', '=', 3);
            $grid->id('ID')->sortable();
            $grid->jobid(trans('Varsity ID'));
            $grid->image(trans('admin.avatar'))->display(function ($s) {
                $url = "http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid.".jpg";
//                $file = file($url);
//                $file = file_exists($url);
//                $file = file_get_contents($url);
//                $file = get_included_files($url);
//                $file = get_required_files($url);
//                $file = @get_headers($url);
//                $file = get_resources($url);


                $ch = curl_init();
                $timeout = 5;

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

                // Get URL content
                $lines_string = curl_exec($ch);
                // close handle to release resources
                curl_close($ch);
                //output, you can also save it locally on the server
                $file = $lines_string;
                if ($file[0] != '<') {
                    return "<img style='max-height:100px; max-width:100px;' src='http://upanel.iiuc.ac.bd:81/Picture/" . $this->jobid . ".jpg' alt='".$this->name."'/>";
                } else {
                    return "<img style='max-height:100px; max-width:100px;' src='/storage/image/user/" . $this->image . "' alt='".$this->name."'/>";
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
            $grid->perPages([10, 25, 20, 25, 30, 35, 40, 45, 50, 100]);


        });
    }
    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
//    public function edit($id)
//    {
//        return Admin::content(function (Content $content) use ($id) {
//            $content->header(trans('user.user'));
//            $content->description(trans('user.edit'));
//            $content->body($this->form()->edit($id));
//        });
//    }

}
