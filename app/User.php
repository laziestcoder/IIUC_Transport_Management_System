<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Encore\Admin\Auth\Database\HasPermissions;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Notifiable, AdminBuilder;//HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'varsity_id', 'password', 'gender', 'user_type', 'adminrole', 'confirmation', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // public function user_type()
    // {
    //     return $this->hasOne(UserType::class);
    // }

}
