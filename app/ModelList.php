<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelList extends Model
{
    // table name
    public $timestamps = true;
    // primary key
    protected $table = 'model_list';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('Encore\Admin\Facades\Admin');
    }
}
