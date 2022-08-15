<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     $posts = Post::all();
    //     return view('home', compact('posts'));
    // }
    
    public function index()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('home', compact('categories', 'subcategories'));
    }
}
