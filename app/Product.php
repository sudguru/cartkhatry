<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function pics() {
        return $this->belongsToMany('App\Pic')->withPivot('display_order', 'caption');
    }

    public function prices() {
        return $this->hasMany('App\ProductPrice');
    }

    public static function product_not_in_the_list_yet($listname) {
        return static::whereNotIn('id', function($query) use($listname) {
            $query->select('product_id')
            ->from('productlists')
            ->where('listname', '=', $listname);
        })->get();
    }
}
