<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    // table name
    protected $table = 'points';
    // primary key
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
