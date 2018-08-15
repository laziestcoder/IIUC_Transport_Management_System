<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use DB;

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
}
