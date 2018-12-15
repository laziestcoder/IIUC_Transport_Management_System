<?php

namespace App;

use Encore\Admin\Auth\Database\HasPermissions;
use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Day extends Model implements AuthenticatableContract
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'day';
    protected $primaryKey = 'id';

    protected $fillable = ['dayname', 'active',];
    use Authenticatable, AdminBuilder, HasPermissions;

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
