<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'emergency_contact';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
