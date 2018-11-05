<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];


    public function children() {
		return $this->hasMany(static::class, 'parent_id');
    }
    
    public function allCategories()
	{
		return $this::with(array(
            'children' => function ($query) {
            $query->orderBy('display_order');
            }
            ))->whereNull('parent_id')
            ->orderBy('display_order')->get();
	}
}
