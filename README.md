This is the README file for ProTalk

To install ProTalk on your local machine, use the following steps:

1. Fork the protalk repository
2. Use git clone to get your fork on your local machine
3. Run the "bin/vendors install" command in the root directory of your installation
4. Make sure the app/cache and app/logs directories are writable by the webserver
5. Create the database and change the parameters.ini in app/config to set the database connection details
6. Run the command "app/console doctrine:schema:create" to create the database tables
7. Import the doc/db/seed_data.sql in your database for initial data
8. Creating a admin user for the backend can be done by running this command: "app/console fos:user:create admin admin@example.com password --super-admin" 