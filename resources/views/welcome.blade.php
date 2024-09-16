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
                    <img src="/img/task_placeholder.png" alt="{{ $task->title }}">
                    <div class="card-body">
                        <p class="card-date">10/09/2021</p>
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-user">User {{$task->user_id}}</p>
                        <a href="/task/{{$task->id}}" class="btn btn-primary">Details</a>


                        @if($task->status != 'completed')
                            <button class="btn btn-success complete-task" data-id="{{ $task->id }}">Complete</button>
                        @endif

                        <a href="/task/edit/{{ $task->id }}" class="btn btn-secondary">Edit</a>

                        <form class="deletetask" action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn">
                                <ion-icon name="trash-outline"></ion-icon> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.complete-task').on('click', function() {
                const taskId = $(this).data('id');

                jQuery.ajax({
                    url: '/tasks/complete/' + taskId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        alert(result.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred: ' + error);
                    }
                });
            });

            $('.deletetask').on('submit', function(event) {
                event.preventDefault();

                const form = $(this);

                jQuery.ajax({
                    url: form.attr('action'),
                    data: form.serialize(),
                    type: 'POST',
                    success: function(result) {
                        alert(result.message);
                        form.closest('.card').remove();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>

@endsection
