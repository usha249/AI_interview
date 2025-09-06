AI Interview Tool (PHP + MySQL) - Full Project

How to run on localhost (XAMPP/WAMP/LAMP):

1. Copy the 'php' folder into your webroot (e.g., C:\\xampp\\htdocs\\php or /var/www/html/php)
2. Import the SQL schema:
   - Using command line:
     mysql -u root -p < php/database_schema.sql
   - Or open in phpMyAdmin and run the SQL.
3. Make uploads folder writable: chmod 775 php/uploads
4. Open in browser: http://localhost/php/index.php

Default DB connection uses environment variables DB_HOST, DB_USER, DB_PASS, DB_NAME. By default it uses root with empty password and database 'ai_interview'.

Admin: create a user via register and manually change role to 'admin' in DB, or insert directly using SQL.
