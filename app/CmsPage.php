<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    public static function getTitleCmsPage()
    {
        return CmsPage::orderBy('id', 'DESC')->select(['id', 'title', 'url'])->get();
    }
}
