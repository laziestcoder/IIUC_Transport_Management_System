<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'day';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
