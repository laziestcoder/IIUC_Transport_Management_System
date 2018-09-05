<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;


class HomeController extends Controller
{
    use HasResourceActions;

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



    /**
     * Make a grid builder.
     *
     * @return Grid
     */


//    public function edit($id)
//    {
//        return Admin::content(function (Content $content) use ($id) {
//
//            $content->header('header');
//            $content->description('description');
//
//            $content->body($this->form()->edit($id));
//        });
//    }



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
