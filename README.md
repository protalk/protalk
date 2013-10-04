Welcome to ProTalk
==================

Welcome to the repository for [ProTalk](http://protalk.me), an online community resource providing a central point of access to audio/ video content with a PHP focus.

Contribute
----------

ProTalk is an open-source project built using [Symfony 2](http://symfony.com/). We welcome contributions from developers of all skills levels.  

###Bugs

If you're too busy, or just not quite ready to help us work on the codebase, you can help by finding and reporting bugs to us via the [issue tracker](https://github.com/protalk/protalk/issues).  

###Code
If you'd like to contribute code, pull requests containing new features or bug fixes are very welcome!

Before getting to work on a new feature, please talk your idea over with a member of the ProTalk development team on the [#protalk](irc://irc.freenode.net/#protalk) freenode IRC channel or open an issue in the tracker and wait for the go ahead.  We have a roadmap of features that we'd like to incorporate into the site and one of the team may already be working on something similar, so it may save you some time in the long run to talk it over with us first.

###Installation

[Joshua Thijssen](http://www.adayinthelifeof.nl) has made it super-easy to get a development environment up and running 'on the fly' using [Vagrant](http://vagrantup.com/) and [Puppet](http://puppetlabs.com/).  With a single command, this powerful tool can set-up or tear-down a fully functional development environment inside an [Oracle VirtualBox](https://www.virtualbox.org/).  It works on all platforms and is the recommended way to get started with ProTalk.  

If you prefer to do things old-school, go ahead and jump down to the [Manual Installation](#manual-installation) instructions at the end of the page.

###Clone the repository

Fork the ProTalk repository, then clone it to your local machine:

	$ cd /path/to/where/you/want/the/cloned/repo/to/be
	$ git clone https://github.com/{YourGitHubUsername}/protalk.git
	$ cd protalk
	$ git submodule update --init

To keep your cloned fork up-to-date with the main ProTalk project repository, add it as a remote:

	$ git remote add upstream https://github.com/protalk/protalk.git

If you are new to Git and need some help with the basic commands, you may find [this basic tutorial](https://github.com/phpmentoring/resources-tools/blob/master/vcs/git-tutorial.md) useful.

###Vagrant/Puppet Installation

To get up and running you need the following installed on your machine:

* [Ruby](http://www.ruby-lang.org/en/downloads/)
* [Vagrant](http://downloads.vagrantup.com/)
* [Oracle VirtualBox](https://www.virtualbox.org/wiki/Downloads)

To check if you already have Ruby installed, you can enter this at the command line:

	$ ruby -v
	
Once you have the required software installed, and you have cloned your fork to your computer, navigate to the protalk root directory and run the following cli command:

	$ vagrant up
	
That's it! I know, it's too easy. The first time you run this command, it may take a few minutes to complete. Subsequent invocations should run much faster.  A VBox window will open and multiple lines of output will appear inside it and at the command line. When it is finished, you will be returned to the command prompt and you can minimise the VBox window out of view (a future release will hide the VBox window for you automatically).

Congratulations, you now have a fully functional ProTalk development environment!

####Newer VirtualBox versions

If you are running a newer version of VirtualBox (like >= 4.2), the provided Vagrant box might not work out-of-the-box for you at the moment. You can read [this small guide](https://github.com/protalk/protalk/wiki/Manually-fixing-Vagrant-for-newer-VirtualBox-versions) to fix the box manually and get it running again.

####URLs

You can view the development version ProTalk or PHPMyAdmin in your browser using the following:

* http://33.33.33.10
* http://33.33.33.10/phpmyadmin         // login credentials are protalk / secret

####app/console activities

This is important, if you need to perform `php app/console` commands as part of your development work, do it _inside_ the Vbox:

	$ vagrant ssh
	$ cd /vagrant         //this is the protalk root directory inside the vbox
	
Other than that, you can work with the code directly in the location you cloned it to.

####Essential Vagrant Commands

Run this command before closing the VBox window, or shutting down your computer:

	$ vagrant suspend
	
This starts the process again:

	$ vagrant resume
	
Run this to destroy the VBox (removing the development environment completely from your machine):

	$ vagrant destroy
	
This creates a new VBox (use this if you destroyed a previous installation):

	$ vagrant up
	
The following command is a housekeeping action which you shouldn't need to worry about, but its here if you want it:

	$ vagrant provision

####Further Reading

If you would like to know more about how this was set up, [read Joshua's informative blog post](http://www.adayinthelifeof.nl/2012/06/29/using-vagrant-and-puppet-to-setup-your-symfony2-environment/).

###Manual Installation

1. Fork the protalk repository
2. Use git clone to get your fork on your local machine
3. Run `ant` - this will install all dependencies, clear the cache and run tests
4. Make sure the app/cache and app/logs directories are writable by the webserver
5. Create the database and change the parameters.yml in app/config to set the database connection details
6. Run the command "app/console doctrine:schema:create" to create the database tables
7. Import the doc/db/seed_data.sql in your database for initial data
8. Creating a admin user for the backend can be done by running this command: "app/console fos:user:create admin admin@example.com password --super-admin

###Doctrine Migrations

ProTalk uses Doctrine Migrations to enable synchronizing database changes between multiple developers. It works by comparing your changes in the entity classes to your database schema and generate
migration files according to the entity changes. Usage:

To check for differences and make new migration file if needed:

    $ app/console doctrine:migrations:diff

New migration file will be created under app/DoctrineMigrations, regardless of whether there are any changes in the entities or not.

If you see there are no SQL statements in the newly generated file, you can remove it.

To make changes to the database according to the SQL statements in the migration files, run:

    $ app/console doctrine:migrations:migrate

It is necessary to always check for new migrations when you pull new code from Github. To see if you have any new migrations to be executed, run:

    $ app/console doctrine:migrations:status

You will see highlighted number in the "New Migrations" section if there are any migrations to be executed.

Please note, that you should never manually modify a table structure that belongs to an entity. Always do a diff and then migrate to update your database. When your diff creates new migration files, it is crucial that you commit these files along with your pull request.

###Writing tests

If you want to contribute by writing unit or functional tests, this is actually quite easy. One example unit test is in the MediaBundle, in src/ProTalk/MediaBundle/Tests/Helpers/Paginator.php.
This is a very basic unit test, but shows how testing works: It's simply writing PHPUnit tests for the classes and all methods. For every class there is one test class, and for each method you can
have one or more test methods. You should not only test the valid use cases, but also test for error use cases.

###Documenting code

Please make an effort to include DocBlocks to every new file and if you see a file that is missing DocBlocks, make a little effort to add them to that file.

Having documented codebase is a joy for others to work on and makes the code more professional.

###Running the tests

Running the tests is simple. Just go to your project root in a console and run:

    $ bin/phpunit

Or if you also want to run tests, checkstyle and linting together just run:

    $ ant

####Further Reading

If you want to read more about writing tests for a Symfony2 project, check [the Symfony2 documentation](http://symfony.com/doc/current/book/testing.html)
