<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'user_role';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
