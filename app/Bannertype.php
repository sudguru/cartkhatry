<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Banner;

class Bannertype extends Model
{
    protected $guarded = [];

    public function banners() {
        return $this->hasMany(Banner::class)->orderBy('display_order');
    }
}
