<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    // table name
    protected $table = 'routes';
    // primary key
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
