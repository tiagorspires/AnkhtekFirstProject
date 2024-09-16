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
            <!-- Cards will be injected here via Ajax -->
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajax({
                url: '/tasks-users',
                type: 'GET',
                success: function(data) {
                    const tasks = data.tasks;
                    const users = data.users;
                    let cardsContainer = $('#cards-container');
                    cardsContainer.empty();

                    tasks.forEach(task => {
                        const user = users.find(user => user.id === task.user_id);
                        const userName = user ? user.name : 'Unknown';

                        // Create the card for each task
                        const taskCard = `
                            <div class="card col-md-3" data-id="${task.id}">
                                <img src="/img/task_placeholder.png" alt="${task.title}">
                                <div class="card-body">
                                    <p class="card-date">${task.created_at}</p>
                                    <h5 class="card-title">${task.title}</h5>
                                    <p class="card-user">User: ${userName}</p>
                                    <a href="/task/${task.id}" class="btn btn-primary">Details</a>
                                    ${task.status != 'completed' ? `<button class="btn btn-success complete-task" data-id="${task.id}">Complete</button>` : ''}
                                    <a href="/task/edit/${task.id}" class="btn btn-secondary">Edit</a>
                                    <form class="deletetask" data-id="${task.id}" action="/tasks/${task.id}" method="POST" style="display:inline;">
                                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon> Delete
                        </button>
                    </form>
                </div>
            </div>
`;
                        cardsContainer.append(taskCard);
                    });

                    // Bind delete function
                    bindDeleteEvent();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred: ' + error);
                }
            });

            // Function to bind delete event to the forms
            function bindDeleteEvent() {
                $('.deletetask').on('submit', function(event) {
                    event.preventDefault();

                    const form = $(this);
                    const taskId = form.data('id');

                    if(confirm("Are you sure you want to delete this task?")) {
                        jQuery.ajax({
                            url: form.attr('action'),
                            data: form.serialize(),
                            type: 'POST',
                            success: function(result) {
                                alert(result.message);
                                $('div.card[data-id="' + taskId + '"]').remove();
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('An error occurred: ' + error);
                            }
                        });
                    }
                });
            }
        });
    </script>

@endsection
