<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tblorderdetail extends Model
{
    protected $guarded = [];

    public function parentorder() {
        return $this->belongsTo('App\Tblorder');
    }
}
