<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public static function getGallery()
    {
        $getGallery     =   Gallery::orderBy('id', 'DESC')->get();

        return $getGallery;
    }
}
