<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Thread;
class SubCategoryController extends Controller
{
    public function subcategory($subcategory){
        $category = SubCategory::where('title',$subcategory)->first();
        $threads = Thread::where('sub_category_id',$category->id)->paginate(10);
        return view('categories.category_threads',compact('threads','subcategory'));
    }


}
