<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->belongsToMany('App\Product')->withPivot('display_order', 'caption');
    }
}
