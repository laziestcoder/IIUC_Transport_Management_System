<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'schedulestudent';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('auth');
    }
}
