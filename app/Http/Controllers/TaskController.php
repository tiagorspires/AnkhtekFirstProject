<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('/welcome', ['tasks' => $tasks]);
    }

    public function show($id = null)
    {
        $task = Task::findOrFail($id);
        return view('tasks/task', ['task' => $task]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function edit($id) {

        $task = Task::findOrFail($id);

        return view('/tasks/edit', ['task' => $task]);

    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
            'userID' => 'required|exists:users,id',
        ]);

        $task = Task::findOrFail($request->id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->user_id = $request->userID;
        $task->save();

        return redirect('/')->with('msg', 'Task successfully updated!');

    }

    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|integer|in:1,2,3',
            'userID' => 'required|exists:users,id',
        ]);

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->user_id = $request->userID;
        $task->save();

        return redirect('/')->with('msg', 'Task successfully created!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect('/')->with('msg', 'Task successfully deleted!');
    }

}
