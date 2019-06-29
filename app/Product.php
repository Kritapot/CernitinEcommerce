<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product_attributes()
    {
        return $this->hasMany(ProductAttributes::class, 'id');
    }


}
