<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productlist extends Model
{
    protected $guarded = [];

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
