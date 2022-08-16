<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::all();
        return view('superadmin.threads.index', compact('threads'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thread = Thread::find($id);
        return view('superadmin.threads.edit', compact('thread'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $thread = Thread::find($id);
        $thread->title = $request->title;
        $thread->description = $request->description;
        $thread->save();
        return redirect()->route('threads.index')->with('success', 'Thread updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thread = Thread::find($id);
        $thread->delete();
        return redirect()->route('threads.index')->with('success', 'Thread deleted successfully');
    }

    public function block(Request $request){
        $thread = Thread::find($request->threadid);
        $thread->is_blocked = 1;
        $thread->blocked_message = $request->blockmessage;
        $thread->save();
        return redirect()->route('threads.index')->with('success', 'Thread blocked successfully');
    }
}
