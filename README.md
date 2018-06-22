
To Run the project follow these steps:

	1. First of all you should have a local server on your machine ex: XAMPP, WAMP...

	2. go to your phpMyAdmin and create new Database and choose name ex: database.

	3. Download Composer to install project dependecies
		you can install it from the link https://getcomposer.org.

	4. Open command prompt and type "Composer --version" to make sure that composer intalled successfully.

	5. Now go to local server root web directory ex:[C:/xampp/htdocs] and make newfolder ex: "task" and clone or download the project folder in it.

	6. Open command prompt and change directory to the project folder ex: "cd c:/xampp/htdocs/task".

	7. Run this command "Composer install" to download Laravel Framework vendor.

	8. After Composer installation finishes, run this command to generate key for the applicaion "php artisan key:generate".

	9. Open the project in your IDE or text editor you use for php and open the file named ".env" and edit your database connections the database name we set before "database" and your phpMyAdmin username and password.

	10. Open the command prompt again and change the path to the project folder and run this command "php artisan migrate" to migrate the migrations to your database in phpMyAdmin.

	11. After the migration finished run this command "php artisan db:seed" to insert an admin in the database to edit products with it.

	12. Finally you can open the project in your browser "localhost/task".

		*You Can login as an admin using these information "email: admin@admin.com" and "password: 123456". # almasriya_task
