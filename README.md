## ToDo Planning Case

This project will handle ToDo Planning for developers with assigning the tasks with balancing their workload.

## Code Philosophy

In this project, I've focused on readability, cleanliness, and maintainability. The application follows the principles
of **SOLID**, **KISS (Keep It Simple, Stupid)** and **DRY (Don't Repeat Yourself)**. While the project is small, I've opted for
simplicity and a bit over-engineering.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing
purposes.

### Prerequisites

Before you begin, ensure you have the following requirements:

- [Composer](https://getcomposer.org/)
- [PHP 8.2](https://www.php.net/releases/8.2/en.php)
- [Node.js](https://nodejs.org/en/download/current)
- [Homebrew](https://brew.sh/)(optional)
- [Laravel Valet](https://laravel.com/docs/11.x/valet)(optional)

1. Clone Repository from Github:

    ```bash
    git clone https://github.com/bugrasercanseker/todo-planning.git todo-planning
    ```

2. Change into the project directory:

    ```bash
    cd todo-planning
    ```

3. Install PHP & NPM dependencies:

    ```bash
    composer install
    npm install

4. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env

5. Update database keys file to `.env`:

    ```bash
    DB_CONNECTION=mysql
    DB_DATABASE=todo_planning
    DB_USERNAME=<username>
    DB_PASSWORD=<password>
   ```

6. Generate the application key:

    ```bash
    php artisan key:generate
    ```

7. Run the database migrations and seeds:

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

3. Build the project:

    ```bash
    npm run build
   
9. Start the development server with Artisan or Valet:

    ```bash
    php artisan serve
    ```

   or if you are using Valet

     ```bash
    valet link todo-planning
    ```
10. Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) or [http://todo-planning.test](http://todo-planning.test) with
    your browser to make sure everything is up and running.

### Imagine the case
![IT Manager planning to-do tasks for his friends.](https://cdn.leonardo.ai/users/4087294c-abac-440c-8090-47e1123d5735/generations/fe21730c-45e5-4ee3-b43c-ffab86dda0b5/Default_Smart_it_guy_wearing_hat_and_glasses_and_planning_todo_0.jpg)
IT Manager planning to-do tasks for his friends.
