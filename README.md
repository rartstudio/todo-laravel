# Todo Laravel

A todo app using tech stack laravel inertia vue3. minimum php v8.1 and node v20.3.0 how to running this app please follow the instructions below:

## Run Locally

Clone the project

```bash
  git clone https://github.com/rartstudio/todo-laravel
```

Go to the project directory

```bash
  cd todo-laravel
```

Install JS dependencies

```bash
  npm install
```

Install PHP dependencies

```bash
  composer install
```

Build JS file

```bash
  npm run Build
```

Copy .env.example to .env

```bash
  cp .env.example .env
```

Generate the key

```bash
  php artisan key:generate
```

Change this line based on prepared database for this app

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=todolaravel
DB_USERNAME=root
DB_PASSWORD=root
```

Running migration

```bash
  php artisan migrate
```

Running seeder

```bash
  php artisan db:seed
```

then running your app. please choose your convenient way
