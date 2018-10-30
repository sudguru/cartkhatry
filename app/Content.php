<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = [];
    public function contenttype() {
        return $this->belongsTo('App\Contenttype');
    }
}
