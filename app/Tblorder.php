<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tblorder extends Model
{
    protected $guarded = [];

    public function orderdetails() {
        return $this->hasMany('App\Tblorderdetail');
    }

    public function merchant() {
        return $this->belongsTo('App\User', 'merchant_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
