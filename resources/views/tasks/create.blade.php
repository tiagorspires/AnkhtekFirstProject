@extends('layouts.main')

@section('title', 'Create Task')

@section('content')

    <div id="task-create-container" class="col-md-6 offset-md-3">
        <h1>Create new task</h1>
        <form id="addtask" action="/tasks" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Task:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Título da tarefa...">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Descrição da tarefa..."></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="1">Pending</option>
                    <option value="2">In Progress</option>
                    <option value="3">Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="number" class="form-control" id="userID" name="userID" placeholder="Usuário">
            </div>
            <input type="submit" class="btn btn-primary" value="Create Task">
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#addtask').on('submit', function(event) {
                event.preventDefault();

                jQuery.ajax({
                    url: "{{ url('/tasks') }}",
                    data: jQuery(this).serialize(),
                    type: 'POST',
                    success: function(result) {
                        alert(result.message);
                        jQuery('#addtask')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Ocorreu um erro: ' + error);
                    }
                });
            });
        });
    </script>

@endsection
