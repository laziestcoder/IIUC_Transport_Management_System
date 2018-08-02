<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'helperinfo';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
