<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'schedule';
    protected $primaryKey = 'id';

    public function user()
    {
        //return $this->belongsTo('Encore\Admin\Facades\Admin');
        //return $this->belongsTo('Encore\Admin\Auth\Database\Administrator');
    }
    public function day()
    {
        return $this->belongsToMany(Day::class);
    }
    public function route()
    {
        return $this->belongsToMany(BusRoute::class);
    }
}
