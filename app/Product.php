<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;
use DB;

class Product extends Model
{
    protected $fillable = [

    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product_attributes()
    {
        return $this->hasMany(ProductAttributes::class, 'product_id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class, 'product_id');
    }

    /**
     * CountCart function
     *
     * @return int
     */
    public static function cartCount()
    {
        if(Auth::check())
        {
            $user_email     =   Auth::user()->email;
            $cartCount      =   DB::table('carts')->where('user_email', $user_email)
                                ->sum('quantity');
        }else {
            $session_id     =   Session::get('session_id');
            $cartCount      =   DB::table('carts')->where('session_id', $session_id)
                                ->sum('quantity');
        }
        return $cartCount;
    }

    /**
     * Count sub_category function
     *
     * @param $cat_id
     * @return int
     */
    public static function productCount($cat_id)
    {
        $productCount       =   Product::where(['category_id' => $cat_id, 'status' => 1])->count();

        return $productCount;
    }



}
