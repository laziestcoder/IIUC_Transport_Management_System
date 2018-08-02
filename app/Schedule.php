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
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
