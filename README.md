# Technical Test - Junior Candidate

This project was developed as part of a technical test. Below are the instructions and a brief explanation of each implemented feature.

## Technologies Used

- **Backend**: Laravel (PHP Framework)
- **Database**: MySQL
- **Frontend**: JavaScript/AJAX
- **Authentication**: Laravel Jetstream

## Requirements to Run the Project

1. **Install Laravel**:
    - Ensure you have Composer installed on your machine.
    - Run the following command to install Laravel globally:
      ```bash
      composer global require laravel/installer
      ```

2. **Install XAMPP**:
    - Download and install XAMPP from [Apache Friends](https://www.apachefriends.org/index.html).
    - Ensure that both MySQL and Apache services are running.

3. **Clone the Repository**:
    - Clone the project repository to your local machine:
      ```bash
      git clone <repository-url>
      cd <project-directory>
      ```

4. **Install Dependencies**:
    - Navigate to the project directory and install the required PHP dependencies:
      ```bash
      composer install
      ```

5. **Set Up Environment File**:
    - Copy the `.env.example` file to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Update the `.env` file with your database credentials:
      ```plaintext
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=<your_database_name>
      DB_USERNAME=<your_username>
      DB_PASSWORD=<your_password>
      ```

6. **Run Migrations**:
    - Run the database migrations to set up the database schema:
      ```bash
      php artisan migrate
      ```

7. **Start the Laravel Development Server**:
    - Run the following command to start the server:
      ```bash
      php artisan serve
      ```

8. **Access the Application**:
    - Open your web browser and go to `http://localhost:8000`.

## API Features

### Entities

#### Tasks
- **id**: Primary key, auto-increment.
- **title**: String, required, up to 255 characters.
- **description**: Text, optional.
- **status**: String, required. Allowed values: `pending`, `in_progress`, `completed`.
- **user_id**: Foreign key to the users table.
- **created_at**: Automatically filled by Laravel.
- **updated_at**: Automatically filled by Laravel.

#### Users
- **id**: Primary key, auto-increment.
- **name**: String, required, up to 255 characters.
- **email**: String, required, unique, up to 255 characters.
- **password**: String, required.
- **created_at**: Automatically filled by Laravel.
- **updated_at**: Automatically filled by Laravel.

### Endpoints

1. **List all tasks**
    - `GET /tasks`
    - **Description**: Returns a list of all tasks with their associated users.

2. **Get details of a specific task**
    - `GET /tasks/{id}`
    - **Description**: Returns the details of a task identified by its ID.

3. **Create a new task**
    - `POST /tasks`
    - **Description**: Creates a new task.
    - **Payload**:
        - `title`: string (required)
        - `description`: text (optional)
        - `status`: string (required)
        - `user_id`: int (required)

4. **Update an existing task**
    - `PUT /tasks/update/{id}`
    - **Description**: Updates a task based on the ID.
    - **Payload**:
        - `title`: string (required)
        - `description`: text (optional)
        - `status`: string (required)
        - `user_id`: int (required)

5. **Delete a task**
    - `DELETE /tasks/{id}`
    - **Description**: Deletes a specific task based on the ID.

6. **List all users**
    - `GET /users`
    - **Description**: Returns a list of all users.

7. **Get details of a specific user**
    - `GET /users/{id?}`
    - **Description**: Returns the details of a user identified by their ID.

### Data Validation
- **Description**: All required fields are validated using Laravel. The `email` field is unique in the `users` table, and the `user_id` field in `tasks` refers to a valid user.

## Frontend

### Simple HTML Page

- **Task Creation Form**
    - Allows the addition of a new task with `title`, `description`, `status`, and `user_id`.

- **Task List**
    - Displays all tasks, including the name of the associated user.

### API Interactions
1. **Load all tasks on page load**
    - Uses AJAX to list tasks when the page is loaded.

2. **Add a new task**
    - Submits the form and dynamically updates the task list.

3. **Delete a task**
    - Button to delete tasks directly from the list.

4. **Mark as completed**
    - Updates the task status to `completed`.

## Complex SQL Query

- **Description**: Query that returns all tasks, the name of the associated user, and the total number of tasks per user, only for tasks with the `in_progress` status.

  ```sql
  SELECT 
    t.id,
    t.title,
    t.description,
    t.status,
    u.name AS user_name,
    COUNT(*) OVER (PARTITION BY u.id) AS total_tasks
  FROM
    tasks t
  JOIN
    users u ON t.user_id = u.id
  WHERE
    t.status = 'in_progress';


### Explanation of the Query:

1. **SELECT**: Selects the desired fields:
    - `t.id`, `t.title`, `t.description`, `t.status`: Fields from the `tasks` table.
    - `u.name AS user_name`: Name of the user from the `users` table.
    - `COUNT(*) OVER (PARTITION BY u.id) AS total_tasks`: Counts the total number of tasks assigned to each user. The use of `OVER (PARTITION BY u.id)` allows counting tasks without grouping the results.

2. **FROM**: Indicates that the query is from the `tasks` table (alias `t`).

3. **JOIN**: Performs a `JOIN` with the `users` table (alias `u`) to associate tasks with users based on the `user_id`.

4. **WHERE**: Filters the results to include only tasks with the status `in_progress`.


