<?php

namespace App\Modules\Api\Controller;

use App\Bll\Lang;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Category;
use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ApiCategoryController extends Controller
{
    protected $user;

//    public function __construct()
//    {
//        $this->user = JWTAuth::parseToken()->authenticate();
//    }
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login']]);
//    }

    public function categories(){

        $cats = Category::join('categories_data', 'categories.id', 'categories_data.category_id')
            ->select('categories.id','categories_data.title', "categories.parent_id")
            //->whereNull('parent_id')
            ->where('categories_data.lang_id', request()->header('lang'))
            ->with("children")
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $cats
        ]);
    }
}
