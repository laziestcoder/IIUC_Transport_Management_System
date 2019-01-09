<?php

//namespace Encore\Admin\Auth\Database;
use Encore\Admin\Auth\Database\AdminTablesSeed;
use Illuminate\Database\Seeder;

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
        $this->call([
            AdminTablesSeed::class,
            ModelListTableSeeder::class,
        ]);
        // $this->runToo();
    }
}


