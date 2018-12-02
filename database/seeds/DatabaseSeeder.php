<?php

//namespace Encore\Admin\Auth\Database;
use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\AdminTablesSeed;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //         $this->call(UsersTableSeeder::class);
        $this->call(AdminTablesSeed::class);
       // $this->runToo();
    }

//    public function runToo()
//    {
//        // create a user.
//        Administrator::truncate();
//        Administrator::create([
//            'username' => 'admin',
//            'password' => bcrypt('admin'),
//            'name' => 'Administrator',
//        ]);
//
//        // create a role.
//        Role::truncate();
//        Role::create([
//            'name' => 'Administrator',
//            'slug' => 'administrator',
//        ]);
//
//        // add role to user.
//        Administrator::first()->roles()->save(Role::first());
//
//        //create a permission
//        Permission::truncate();
//        Permission::insert([
//            [
//                'name' => 'All permission',
//                'slug' => '*',
//                'http_method' => '',
//                'http_path' => '*',
//            ],
//            [
//                'name' => 'Dashboard',
//                'slug' => 'dashboard',
//                'http_method' => 'GET',
//                'http_path' => '/',
//            ],
//            [
//                'name' => 'Login',
//                'slug' => 'auth.login',
//                'http_method' => '',
//                'http_path' => "/auth/login\r\n/auth/logout",
//            ],
//            [
//                'name' => 'User setting',
//                'slug' => 'auth.setting',
//                'http_method' => 'GET,PUT',
//                'http_path' => '/auth/setting',
//            ],
//            [
//                'name' => 'Auth management',
//                'slug' => 'auth.management',
//                'http_method' => '',
//                'http_path' => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
//            ],
//        ]);
//
//        Role::first()->permissions()->save(Permission::first());
//
//        // add default menus.
//        Menu::truncate();
//        Menu::insert([
//
//            [
//                //'id' => 1,
//                'parent_id' => 0,
//                'order' => 1,
//                'title' => 'Index',
//                'icon' => 'fa-bar-chart',
//                'uri' => '/',
//            ],
//
//            [
//                'parent_id' => 0,
//                'order' => 2,
//                'title' => 'Admin Dashboard',
//                'icon' => 'fa-yelp',
//                'uri' => '/admin-dashboard',
//            ],
//
//            [
//                'parent_id' => 42,
//                'order' => 3,
//                'title' => 'Schedule Dashboard',
//                'icon' => 'fa-android',
//                'uri' => '/admin-dashboard',
//            ],
//
//            [
//                'parent_id' => 42,
//                'order' => 4,
//                'title' => 'Emergency Contact',
//                'icon' => 'fa-warning',
//                'uri' => '/emergency-contact',
//            ],
//
//            [
//                //'id' => 2,
//                'parent_id' => 0,
//                'order' => 5,
//                'title' => 'Admin',
//                'icon' => 'fa-tasks',
//                'uri' => '',
//            ],
//
//            [
//                //'id' => 3,
//                'parent_id' => 2,
//                'order' => 6,
//                'title' => 'Users',
//                'icon' => 'fa-users',
//                'uri' => 'auth/users',
//            ],
//
//            [
//                //'id' => 4,
//                'parent_id' => 2,
//                'order' => 7,
//                'title' => 'Roles',
//                'icon' => 'fa-user',
//                'uri' => 'auth/roles',
//            ],
//
//            [
//                //'id' => 5,
//                'parent_id' => 2,
//                'order' => 8,
//                'title' => 'Permission',
//                'icon' => 'fa-ban',
//                'uri' => 'auth/permissions',
//            ],
//
//            [
//                //'id' => 6,
//                'parent_id' => 2,
//                'order' => 9,
//                'title' => 'Menu',
//                'icon' => 'fa-bars',
//                'uri' => 'auth/menu',
//            ],
//
//            [
//                //'id' => 7,
//                'parent_id' => 2,
//                'order' => 10,
//                'title' => 'Operation log',
//                'icon' => 'fa-history',
//                'uri' => 'auth/logs',
//            ],
//
//            [
//                'parent_id' => 2,
//                'order' => 11,
//                'title' => 'Exception Reporter',
//                'icon' => 'fa-bug',
//                'uri' => 'exceptions',
//            ],
//
//            [
//                'parent_id' => 2,
//                'order' => 12,
//                'title' => 'Helpers',
//                'icon' => 'fa-gears',
//                'uri' => NULL,
//            ],
//
//            [
//                'parent_id' => 24,
//                'order' => 13,
//                'title' => 'Scaffold',
//                'icon' => 'fa-keyboard-o',
//                'uri' => 'helpers/scaffold',
//            ],
//
//            [
//                'parent_id' => 24,
//                'order' => 14,
//                'title' => 'Database terminal',
//                'icon' => 'fa-database',
//                'uri' => 'helpers/terminal/database',
//            ],
//
//            [
//                'parent_id' => 24,
//                'order' => 15,
//                'title' => 'Laravel Artisan',
//                'icon' => 'fa-terminal',
//                'uri' => 'helpers/terminal/artisan',
//            ],
//
//            [
//                'parent_id' => 24,
//                'order' => 16,
//                'title' => 'Routes',
//                'icon' => 'fa-list-alt',
//                'uri' => 'helpers/routes',
//            ],
//
//            [
//                //'id' => 11,
//                'parent_id' => 0,
//                'order' => 17,
//                'title' => 'Media Manager',
//                'icon' => 'fa-file-photo-o',
//                'uri' => 'media',
//            ],
//            [
//                //'id' => 12,
//                'parent_id' => 0,
//                'order' => 18,
//                'title' => 'Messages',
//                'icon' => 'fa-envelope',
//                'uri' => '/messages',
//            ],
//            [
//                'parent_id' => 12,
//                'order' => 19,
//                'title' => 'New Message',
//                'icon' => 'fa-newspaper-o',
//                'uri' => '/messages/create',
//            ],
//            [
//                'parent_id' => 12,
//                'order' => 20,
//                'title' => 'View Messages',
//                'icon' => 'fa-envelope-o',
//                'uri' => '/messages',
//            ],
//
//            [
//                'parent_id' => 0,
//                'order' => 21,
//                'title' => 'Notice',
//                'icon' => 'fa-files-o',
//                'uri' => '/auth/notices',
//            ],
//
//            [
//                'parent_id' => 16,
//                'order' => 22,
//                'title' => 'Admin-Notice',
//                'icon' => 'fa-clipboard',
//                'uri' => '/auth/transport-notice',
//            ],
//            [
//                'parent_id' => 16,
//                'order' => 23,
//                'title' => 'New Notice',
//                'icon' => 'fa-pencil-square-o',
//                'uri' => '/auth/transport-notice/create',
//            ],
//            [
//                //'id' => 9,
//                'parent_id' => 0,
//                'order' => 24,
//                'title' => 'Route Information',
//                'icon' => 'fa-info-circle',
//                'uri' => '/auth/bus-route-info',
//            ],
//
//            [
//                'parent_id' => 9,
//                'order' => 25,
//                'title' => 'Route-Student-Bus',
//                'icon' => 'fa-check-square-o',
//                'uri' => '/auth/routes',
//            ],
//
//            [
//                'parent_id' => 9,
//                'order' => 26,
//                'title' => 'Student Individual Info',
//                'icon' => 'fa-check-square',
//                'uri' => 'auth/bus-route-info',
//            ],
//
//            [
//                'parent_id' => 0,
//                'order' => 27,
//                'title' => 'Bus Student Infomation',
//                'icon' => 'fa-bars',
//                'uri' => '/auth/bus-student-info',
//            ],
//
//            [
//                //'id' => 8,
//                'parent_id' => 0,
//                'order' => 28,
//                'title' => 'Bus-Routinig',
//                'icon' => 'fa-road',
//                'uri' => NULL,
//            ],
//
//            [
//                //'id' => 10,
//                'parent_id' => 8,
//                'order' => 29,
//                'title' => 'Bus Route',
//                'icon' => 'fa-plus-square-o',
//                'uri' => '/auth/route',
//            ],
//
//            [
//                'parent_id' => 8,
//                'order' => 30,
//                'title' => 'Bus Stop Point',
//                'icon' => 'fa-plus-square',
//                'uri' => '/auth/point',
//            ],
//            [
//                'parent_id' => '8',
//                'order' => 31,
//                'title' => 'Add Time',
//                'icon' => 'fa-clock-o',
//                'uri' => '/auth/time',
//            ],
//            [
//                'parent_id' => 8,
//                'order' => 32,
//                'title' => 'New Day',
//                'icon' => 'fa-calendar',
//                'uri' => '/auth/day',
//            ],
//            [
//                'parent_id' => 8,
//                'order' => 33,
//                'title' => 'Bus Type',
//                'icon' => 'fa-simplybuilt',
//                'uri' => '/auth/bus-type',
//            ],
//            [
//                'parent_id' => 0,
//                'order' => 34,
//                'title' => 'Bus Schedule',
//                'icon' => 'fa-bars',
//                'uri' => '/auth/schedule',
//            ],
//            [
//                'parent_id' => 19,
//                'order' => 35,
//                'title' => 'Day Wise Schedule',
//                'icon' => 'fa-bars',
//                'uri' => '/auth/schedule',
//            ],
//            [
//                'parent_id' => 19,
//                'order' => 36,
//                'title' => 'New Schedule',
//                'icon' => 'fa-cube',
//                'uri' => 'auth/bus-schedule/create',
//            ],
//
//            [
//                'parent_id' => 17,
//                'order' => 37,
//                'title' => 'Schedule',
//                'icon' => 'fa-cubes',
//                'uri' => 'auth/bus-schedule',
//            ],
//
//            [
//                'parent_id' => 0,
//                'order' => 38,
//                'title' => 'Bus-Driver-Helper',
//                'icon' => 'fa-bus',
//                'uri' => NULL,
//            ],
//            [
//                'parent_id' => 17,
//                'order' => 39,
//                'title' => 'Bus',
//                'icon' => 'fa-train',
//                'uri' => '/auth/bus',
//            ],
//            [
//                'parent_id' => 17,
//                'order' => 40,
//                'title' => 'Driver',
//                'icon' => 'fa-odnoklassniki',
//                'uri' => '/auth/driver',
//            ],
//            [
//                'parent_id' => 17,
//                'order' => 41,
//                'title' => 'Helper',
//                'icon' => 'fa-odnoklassniki-square',
//                'uri' => '/auth/helper',
//            ],
//
//            [
//                'parent_id' => '0',
//                'order' => 42,
//                'title' => 'User',
//                'icon' => 'fa-users',
//                'uri' => '/auth/',
//            ],
//            [
//                'parent_id' => 30,
//                'order' => 43,
//                'title' => 'Student',
//                'icon' => 'fa-scribd',
//                'uri' => '/auth/students',
//            ],
//            [
//                'parent_id' => 30,
//                'order' => 44,
//                'title' => 'Faculty',
//                'icon' => 'fa-facebook-f',
//                'uri' => '/auth/teachers',
//            ],
//            [
//                'parent_id' => 30,
//                'order' => 45,
//                'title' => 'Officer-Staff',
//                'icon' => 'fa-circle-o',
//                'uri' => '/auth/officer-staff',
//            ],
//
//
//            [
//                'parent_id' => 30,
//                'order' => 46,
//                'title' => 'User-Role',
//                'icon' => 'fa-user-plus',
//                'uri' => '/auth/user-role',
//            ],
//
//
//
//
//        ]);
//
//        // add role to menu.
//        Menu::find(2)->roles()->save(Role::first());
//    }

}
