<?php

namespace App\Modules\Admin\Controllers;

use App\Bll\Lang;
use App\Global_T;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryData;
use App\Modules\Admin\Models\Language;
use App\Modules\Menus\Models\MenuItem;
use App\Modules\Menus\Models\MenuItemData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{

    protected function index()
    {
//        $category = Category::where('id', 1)->first();
       // dd($all = \App\Bll\Lang::get_all_categories() );
        //get language list
        $langId = Lang::getDefaultLangId();
        $langs = Language::get();
        $query = Category::leftJoin('categories_data', 'categories_data.category_id', 'categories.id')
            ->where('categories_data.lang_id', $langId)
            ->select('categories.id' , 'categories_data.title', 'categories_data.lang_id');
        $parents = $query->get();

        if (request()->ajax()) {
            return DataTables::of($query)
                ->order(function ($query) {
                    $query->orderBy('id', 'Desc');
                })
                // item title and url
                ->addColumn('title', function ($row) {
                    $cat_data = CategoryData::where('category_id', $row->id)->first();
                    return $cat_data->title ?? "No translation";
                })
                ->addColumn('language', function ($row) {
                    $lang = Language::find($row->lang_id)->title;
                    return $lang;
                })
                ->addColumn('action', function ($row)  use($langs){
                    $btn = '<button id="' . $row->id . '" class="btn btn-primary btn-sm edit" onclick="edit(' . $row->id . ')" title="Edit Item"><i class="fa fa-edit"></i></button>';
                    return $btn;
                })
                ->rawColumns(['title','language','action'])
                ->make(true);
        }

        return view('admin.category.index', ['languages' => $langs, 'parents' => $parents]);

    }
    protected function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|unique:categories_data|max:255'
        ]);
        $default_lang = Lang::getDefaultLangId();
        $cat = Category::create([
            'parent_id' => $request->parent,
        ]);
        CategoryData::create([
            "category_id" => $cat->id,
            "title" => $request["title"],
            "lang_id" => $request["language"] ?? $default_lang ,
        ]);
        return response()->json(["status" => true]);
    }
    protected function edit($id)
    {
        //dd($id);
        $default_lang = Lang::getDefaultLangId();
        $item = Category::findOrFail($id);
        $item_data = CategoryData::where('category_id', $id)->where("lang_id", $default_lang)->first();
        return response()->json(['item' => $item, 'item_data' => $item_data]);
    }
    protected function update( Request $request)
    {
        //dd($request->all());
        $default_lang = Lang::getDefaultLangId();
        $cat = Category::findOrFail($request->itemId);
        $catData = CategoryData::where('category_id' , $cat->id)->where("lang_id", $default_lang)->first();

        $validator = $request->validate([
            'title' => ['required','max:191', Rule::unique('categories_data')->ignore($catData->id),],
        ]);

        $cat->update([ 'parent_id' => $request->parent ]);

        $catData->update([
            "category_id" => $cat->id,
            "title" => $request["title"],
            "lang_id" => $request["language"] ?? $default_lang ,
        ]);
        return response()->json(["status" => true]);
    }

    protected function get_parent()
    {
        $default_lang = Lang::getDefaultLangId();
        $parents = Category::leftJoin('categories_data', 'categories_data.category_id', 'categories.id')
            ->where('categories_data.lang_id', $default_lang)->select('categories.id' , 'categories_data.title')
            ->get();
        return response()->json($parents);
    }

}
