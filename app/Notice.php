<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    // table name
    protected $table = 'notices';
    // primary key
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}