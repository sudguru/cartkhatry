<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenttype extends Model
{
    protected $guarded = [];

    public function contents() {
        return $this->hasMany('App\Contents');
    }
}
