<?php

return [

    /*
     * Laravel-admin name.
     */
    'name' => 'ITMS-Admin Panel',

    /*
     * Logo in admin panel header.
     */
    'logo' => '<b>ITMS</b> Admin Panel',

    /*
     * Mini-logo in admin panel header.
     */
    'logo-mini' => '<b>IAP</b>',

    /*
     * Route configuration.
     */
    'route' => [

        'prefix' => 'admin',

        'namespace' => 'App\\Admin\\Controllers',

        'middleware' => ['web', 'admin'],
    ],

    /*
     * Laravel-admin install directory.
     */
    'directory' => app_path('Admin'),

    /*
     * Laravel-admin html title.
     */
    'title' => 'ITMS Admin Panel',

    /*
     * Use `https`.
     */
    'secure' => false,

    /*
     * Laravel-admin auth setting.
     */
    'auth' => [
        // The below line is written by developers
        // 'controller' => App\Admin\Controllers\AuthController::class,

        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model' => Encore\Admin\Auth\Database\Administrator::class,
            ],
        ],
    ],

    /*
     * Laravel-admin upload setting.
     */
    'upload' => [

        'disk' => 'admin',

        'directory' => [
            'image' => 'images',
            'file' => 'files',
        ],
    ],


    /*
     * Laravel-admin database setting.
     */
    'database' => [

        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => Encore\Admin\Auth\Database\Administrator::class,

        // Role table and model.
        'roles_table' => 'admin_roles',
        'roles_model' => Encore\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table' => 'admin_menu',
        'menu_model' => Encore\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table' => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table' => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table' => 'admin_role_menu',
    ],

    /*
     * By setting this option to open or close operation log in laravel-admin.
     */
    'operation_log' => [

        'enable' => true,

        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs
         */
        'except' => [
            'admin/auth/logs*',
        ],
    ],

    /*
     * @see https://adminlte.io/docs/2.4/layout
     */

    //'skin' => 'skin-red',
    //'skin' => 'skin-red-light',

    //'skin' => 'skin-black',
    //'skin' => 'skin-black-light',

    //'skin' => 'skin-blue',
    //'skin' => 'skin-blue-light',

    //'skin' => 'skin-green',
    'skin' => 'skin-green-light',

    //'skin' => 'skin-purple',
    //'skin' => 'skin-purple-light',

    //'skin' => 'skin-yellow',
    //'skin' => 'skin-yellow-light',


    /*
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
     */
    'layout' => ['sidebar-mini', 'sidebar-collapse',],

      /*
    |--------------------------------------------------------------------------
    | Login page background image
    |--------------------------------------------------------------------------
    |
    | This value is used to set the background image of login page.
    |
    */
    'login_background_image' => ' ',


    /*
     * Version displayed in footer.
     */
//    'version' => '1.5.x-dev',

    /*
     * Settings for extensions.
     */
    'extensions' => [

        'media-manager' => [

            // Select a local disk that you configured in `config/filesystem.php`
            'disk' => 'admin'
        ],

        'material-ui' => [
            // If the value is set to false, this extension will be disabled
            'enable' => false
        ],

        'cropper' => [
            //Set to false if you want to turn off this extension
            'enable' => true,
        ],
        'grid-lightbox' => [

            // Set to `false` if you want to disable this extension
            'enable' => true,
        ],
        'sparkline' => [

            // Set to `false` if you want to disable this extension
            'enable' => true,
        ],
    ],
];
