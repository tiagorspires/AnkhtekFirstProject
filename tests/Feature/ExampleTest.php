<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response_for_tasks_create(): void
    {
        $response = $this->get('/tasks/create');

        $response->assertStatus(200);
    }


    public function test_the_application_returns_a_successful_response_for_users(): void
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response_for_user_show(): void
    {


        $users = \App\Models\User::all();

        foreach ($users as $user) {
            $response = $this->get('/user/'.$user->id);
            $response->assertStatus(200);
        }

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response_for_tasks_users(): void
    {
        $response = $this->get('/tasks-users');

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response_for_task_show(): void
    {
        $tasks = \App\Models\Task::all();

        foreach ($tasks as $task) {
            $response = $this->get('/task/'.$task->id);
            $response->assertStatus(200);
        }

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response_for_task_edit(): void
    {
        $tasks = \App\Models\Task::all();

        foreach ($tasks as $task) {
            $response = $this->get('/task/edit/'.$task->id);
            $response->assertStatus(200);
        }

        $response->assertStatus(200);
    }

    public function test_the_application_returns_a_successful_response_for_tasks_update(): void
    {
        $tasks = \App\Models\Task::all();

        foreach ($tasks as $task) {
            $response = $this->put('/tasks/update/'.$task->id, [
                'title' => 'Task title',
                'description' => 'Task description',
                'status' => 1,
                'userID' => 1,
            ]);
            $response->assertStatus(302);
        }

        $response->assertStatus(302);
    }

    public function test_the_application_returns_a_successful_response_for_tasks_complete(): void
    {
        $tasks = \App\Models\Task::all();

        foreach ($tasks as $task) {
            $response = $this->post('/tasks/complete/'.$task->id);
            $response->assertStatus(200);
        }

        $response->assertStatus(200);
    }



}
