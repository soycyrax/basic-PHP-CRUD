# basic-PHP-CRUD

A simple PHP and MySQL CRUD project for adding, viewing, editing, and deleting name/location records.

## Tech Stack

- PHP
- MySQL / MariaDB
- Apache
- Bootstrap 4
- XAMPP recommended for local development

## Recommended Local Setup

Use XAMPP 7.4.33 for best compatibility with this older project.

The original SQL dump was created with:

- PHP 7.3.10
- MariaDB 10.4.8
- phpMyAdmin 4.9.1

XAMPP 7.4.33 is close to that environment and works well for this codebase.

## How To Run

1. Install XAMPP.

   Recommended version:

   ```text
   XAMPP 7.4.33 / PHP 7.4.33 for Windows
   ```

2. Copy this project folder into XAMPP's web root:

   ```text
   C:\xampp\htdocs\basic-PHP-CRUD
   ```

3. Open the XAMPP Control Panel.

4. Start:

   ```text
   Apache
   MySQL
   ```

5. Open phpMyAdmin:

   ```text
   http://localhost/phpmyadmin
   ```

6. Create a database named:

   ```text
   crud
   ```

7. Import the included SQL file:

   ```text
   crud.sql
   ```

8. Open the project in your browser:

   ```text
   http://localhost/basic-PHP-CRUD/
   ```

## Database Configuration

The project connects to MySQL using these settings:

```php
$mysqli = new mysqli('localhost', 'root', '', 'crud');
```

That means the local database must be named `crud`, and the default XAMPP MySQL user should be `root` with no password.

## Common Error

If you see this error:

```text
Unknown database 'crud'
```

Create the `crud` database in phpMyAdmin and import `crud.sql`.

## Project Files

- `index.php` - main page that lists records and shows the add form
- `process.php` - handles create, update, and delete actions
- `crud.sql` - database schema and sample data

## Note

This is an old beginner CRUD project. It is suitable for local learning, but it uses raw SQL queries and should not be deployed publicly without security improvements such as prepared statements and input validation.
