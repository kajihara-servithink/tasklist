<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) 
             $user = \Auth::user();
        $tasks = Task::all();
        
        return view('tasks.index',[
            'tasks' =>$tasks,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create',[
            'task' =>$task,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status'=>'required|max:10',
            'content'=>'required|max:10',
            ]);
            
        $task = new Task;
        $task->status =  $request->status;
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        return view('tasks.show',[
            'task'=>$task,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task =Task::findOrFail($id);
        
        return view('tasks.edit',[
            'task'=>$task,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'status'=>'required|max:10',
            'content'=>'required|max:10',
            ]);
            $task =Task::findOrFail($id);
            
            $task->status =$request->status;
            $task->content =$request->content;
            $task->save();
        
        return redirect('/');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        $task->delete();
        
        return redirect('/');
    }
}
