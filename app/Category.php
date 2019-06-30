<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getUrlAttribute($value)
    {
        return !empty($value) ? $value : "";
    }


}
