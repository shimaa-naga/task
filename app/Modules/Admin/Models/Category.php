<?php

namespace App\Modules\Admin\Models;

use App\Bll\Lang;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    public $timestamps = true;

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    public function translation()
    {
        $cat = $this->hasOne(CategoryData::class, 'category_id', 'id')->where('lang_id', Lang::getDefaultLangId());
        if ($cat->first() == null)
            $cat = $this->hasOne(CategoryData::class, 'category_id', 'id');

        return $cat;
    }

}
