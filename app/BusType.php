<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusType extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'bus_type';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
