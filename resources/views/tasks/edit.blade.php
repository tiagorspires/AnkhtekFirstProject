@extends('layouts.main')

@section('title', 'Edit Task')

@section('content')

    <div id="task-create-container" class="col-md-6 offset-md-3">
        <h1>Edit task {{$task -> id}}</h1>
        <form action="/tasks/update/{{$task -> id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Task:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Task title...">
            </div>
            <div class="form-group">
                <label for="title">Description:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Description of the task..."></textarea>
            </div>
            <div class="form-group">
                <label for="title">Status:</label>
                <select name="status" id="private" class="form-control">
                    <option value="1">Pending</option>
                    <option value="2">In Progress</option>
                    <option value="3">Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">User ID:</label>
                <input type="number" class="form-control" id="userID" name="userID" placeholder="User">
            </div>
            <input type="submit" class="btn btn-primary" value="Update">
        </form>
    </div>

@endsection
