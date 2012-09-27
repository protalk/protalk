ProTalk
=======

Welcome to [ProTalk](http://protalk.me), a brand new and exciting open source project.

Mission
-------

We are an online community-driven resource providing a central point of access to audio/ video content with a PHP focus.  

We have big plans for the site which include expanding into other programming languages in the future.  In the meantime, we're covering all aspects of PHP and associated tools.

We soft-launched at DPC12, so we're box-fresh and still in beta - new features and content are being added all the time.

Contributors
------------

Want to help?  Thanks to [JayTaph](https://github.com/jaytaph/) we have a cutting-edge Vagrant/ Puppet setup which makes creating a stable and reliable ProTalk development environment an absolute doddle.

Installation
------------

Vagrant installation: More info on this will follow shortly

Manual installation:

1. Fork the protalk repository
2. Use git clone to get your fork on your local machine
3. Run the "bin/vendors install" command in the root directory of your installation
4. Make sure the app/cache and app/logs directories are writable by the webserver
5. Create the database and change the parameters.ini in app/config to set the database connection details
6. Run the command "app/console doctrine:schema:create" to create the database tables
7. Import the doc/db/seed_data.sql in your database for initial data
8. Creating a admin user for the backend can be done by running this command: "app/console fos:user:create admin admin@example.com password --super-admin
