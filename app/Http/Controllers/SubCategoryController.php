<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
class SubCategoryController extends Controller
{
    public function __construct()
    {
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $file = $request->file('image');
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('/public/subcategories', $file_name);
        $subcategory = new SubCategory();
        $subcategory->title = $request->title;
        $subcategory->category_id = $request->category;
        $subcategory->image = $file_name;
        $subcategory->description = $request->description;
        $subcategory->save();
        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = SubCategory::find($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        $subcategory = SubCategory::find($id);
        if($request->has('image')){
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/subcategories', $file_name);
            $category->image = $file_name;
        }
        $subcategory->title = $request->title;
        $subcategory->category_id = $request->category;
        $subcategory->description = $request->description;
        $subcategory->save();
        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCategory::find($id)->delete();
        return redirect()->back();
    }
}
