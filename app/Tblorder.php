<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tblorder extends Model
{
    protected $guarded = [];

    public function orderdetails() {
        return $this->hasMany('App\Tblorderdetail');
    }
}
