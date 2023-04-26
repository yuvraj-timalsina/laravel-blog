
# Laravel Blog

 Laravel Blog Management System.



## Installation

Clone the project using SSH or HTTPS.

```bash
git@github.com:yuvraj-timalsina/laravel-blog.git
```
    
## Run Locally

Go to the Project Directory

```bash
cd laravel-blog
```
Create and configure the Database

```bash
sudo mysql -u <username> -p
create database laravel_blog;
```
Install Dependencies

```bash
composer install
```

Generate Application Key

```bash
php artisan key:generate
```

Run the Database Migrations and Seeders

```bash
php artisan migrate:fresh --seed
```

Create a Symbolic Link to Storage

```bash
php artisan storage:link
```

Run the Server

```bash
php artisan serve
```


## Author

- [@yuvraj-timalsina](https://www.github.com/yuvraj-timalsina)
