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

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $task = new Task;
        /*
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();
        */
        return redirect('/')->with('msg', 'Tarefa criada com sucesso!');
    }
}
