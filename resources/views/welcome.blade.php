@extends('layouts.main')

@section('title', 'Main Page')

@section('content')

    <div id="search-container" class="col-md-12">
        <h1>Search for a task</h1>
        <form action="">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
        </form>
    </div>

    <div id="events-container" class="col-md-12">
        <h2>Next tasks</h2>
        <div id="cards-container" class="row">
            @foreach($tasks as $task)
                <div class="card col-md-3">
                    <img src="/img/task_placeholder.png" alt="{{ $task -> title }}">
                    <div class="card-body">
                        <p class="card-date">10/09/2021</p>
                        <h5 class="card-title">{{ $task -> title }}</h5>
                        <p class="card-user">User {{$task -> user_id}}</p>
                        <a href="#" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>
            @endforeach
        </div>



@endsection
