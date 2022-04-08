<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    public $timestamps = true;
    protected $guarded = [];
}
