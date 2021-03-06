<?php

namespace App;

use Encore\Admin\Auth\Database\HasPermissions;
use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model implements AuthenticatableContract
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'user_type';
    protected $primaryKey = 'id';

    use Authenticatable, AdminBuilder, HasPermissions;

    protected $fillable = ['name'];

    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }
}
