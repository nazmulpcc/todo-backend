# todo-backend
> PHP Backend for a simple todo application

## Tech Overview
This project uses `symfony/http-foundation` to handle requests and responses.
`bramus/router` is the fantastic router package used to handle all the routing.
The infamous Eloquent ORM (`illuminate/database`) is used to handle database queries, relationships and migrations.
It can be debated that and ORM and a separate Router package is overkill for a small project like this,
but these are battle tested packages that increases security, code readability and extensibility.

## Setup
1. Copy the `.env.example` file to `.env`
2. `JWT_KEY` is needed to encode and verify JWT tokens. Use a random string.
3. Update Database credentials.
4. Run `php database/migrate.php` from command line to initialize the database. 
5. A demo account with email `admin@admin.com` and password `secret` is automatically created and ready to use.
6. You can run `php -S localhost:8080` which will start a development server at `localhost:8080`. Any free port can be used.
