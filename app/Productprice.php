<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productprice extends Model
{
    protected $guarded = [];

    public function size() {
        return $this->belongsTo('App\Size');
    }


}
