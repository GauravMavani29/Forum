<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Thread;
use App\Models\ThreadReply;
use App\Models\SubCategory;
use Auth;
class ThreadController extends Controller
{
    public function create($subcategory){
        return view('threads.create',compact('subcategory'));
    }

    public function store(Request $request,$subcategory){
        $category = SubCategory::where('title',$subcategory)->first();
        $thread = new Thread();
        $thread->title = $request->title;
        $thread->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->title)).'-'.Str::random(5);
        $thread->description = $request->description;
        $thread->subcategory_id = $category->id;
        $thread->user_id = Auth::user()->id;
        $thread->save();
        return redirect()->route('subcategory.thread',$request->subcategory);
    }

    public function show($slug){
        $thread = Thread::where('slug',$slug)->first();
        return view('threads.show',compact('thread'));
    }

}
