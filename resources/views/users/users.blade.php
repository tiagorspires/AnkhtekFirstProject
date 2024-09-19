@extends('layouts.main')

@section('title', 'Users Page')

@section('content')

    <div id="search-container" class="col-md-12">
        <h1>Search for a user</h1>
        <form action="/users" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
        </form>
    </div>

    <div id="events-container" class="col-md-12">
        <h2>Users</h2>
        <div id="cards-container" class="row">
            @foreach($users as $user)
                <div class="card col-md-3">
                    <img src="/img/task_placeholder.png" alt="{{ $user -> id }}">
                    <div class="card-body">
                        <p class="card-date">10/09/2021</p>
                        <h5 class="card-title">User name: {{ $user -> name }}</h5>
                        <p class="card-task">User ID: {{$user -> id}}</p>
                        <p class="card-task">User email: {{$user -> email}}</p>
                    </div>
                </div>
            @endforeach
        </div>



@endsection
