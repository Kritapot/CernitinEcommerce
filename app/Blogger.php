<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogger extends Model
{
    public static function showBlogHomepage()
    {
        $blogTitle      =   Blogger::orderBy('id', 'DESC')
                            ->select(['id', 'title'])
                            ->get();

        return $blogTitle;
    }

}
