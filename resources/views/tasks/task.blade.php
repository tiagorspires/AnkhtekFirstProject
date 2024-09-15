@extends('layouts.main')

@section('title', 'Task')

@section('content')

    @if(($task -> id) != null)
        <p>Task id: {{$task -> id }}<br>
        Task title: {{$task -> title }}<br>
        Task description: {{$task -> description }}<br>
        Task user id: {{$task -> user_id }}<br>
        </p>

    @endif

@endsection
