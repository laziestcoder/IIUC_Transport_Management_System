<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusStudentInfo extends Model
{
    // table name
    public $timestamps = false;
    // primary key
    protected $table = 'bus_student_information';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
