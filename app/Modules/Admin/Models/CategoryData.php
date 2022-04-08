<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryData extends Model
{
    protected $table = 'categories_data';
    protected $guarded = [];
    public $timestamps = true;

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}
