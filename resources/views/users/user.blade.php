@extends('layouts.main')

@section('title', 'User')

@section('content')

    @if(($user -> id) != null)
        <p>user id: {{$user -> id }}<br>
            user name: {{$user -> name }}<br>
            user email: {{$user -> email }}<br>
        </p>

    @endif

@endsection
