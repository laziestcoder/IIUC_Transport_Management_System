<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminDashboard extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'dashboard';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
