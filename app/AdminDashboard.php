<?php

namespace App;
//namespace Encore\Admin\Auth\Database;

use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Encore\Admin\Auth\Database\HasPermissions;


class AdminDashboard extends Model implements AuthenticatableContract
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'dashboard';
    protected $primaryKey = 'id';

    use Authenticatable, AdminBuilder, HasPermissions;

    protected $fillable = ['special_schedule', 'regular_schedule', 'holiday', 'schedule_suspend', 'schedule_edit', 'editdate'];



    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
