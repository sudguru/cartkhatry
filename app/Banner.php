<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bannertype;
class Banner extends Model
{
    protected $guarded = [];

    public function bannertype() {
        return $this->belongsTo(Bannertype::class);
    }
}
