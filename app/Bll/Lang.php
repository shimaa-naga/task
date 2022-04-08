<?php

namespace App\Bll;

use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\Language;
use Illuminate\Support\Facades\Config;

class Lang
{
    public static function getDefaultLangId(){
        $langCode = Config::get('app.locale','en');
        $language = Language::where('code',$langCode)->first();
        if(isset($language)){
            return $language->id;
        }
    }

    static function get_all_categories()
    {
        return Category::join('categories_data', 'categories.id', 'categories_data.category_id')
            ->select('categories.id','categories_data.title', "categories.parent_id")
            //->whereNull('parent_id')
            ->where('categories_data.lang_id', Lang::getDefaultLangId())
            ->with("children")
            ->cursor();
    }

}
