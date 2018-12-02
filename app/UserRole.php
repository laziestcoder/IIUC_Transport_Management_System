<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Encore\Admin\Auth\Database\HasPermissions;

class UserRole extends Model  implements AuthenticatableContract
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'user_role';
    protected $primaryKey = 'id';

    use Authenticatable, AdminBuilder, HasPermissions;

    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
