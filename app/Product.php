<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function allpics() {
        return $this->hasMany('App\Pic');
    }
    public function pics() {
        return $this->hasMany('App\Pic')->whereNull('deleted')->orderBy('display_order');
    }
}
