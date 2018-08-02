<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'driverinfo';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
