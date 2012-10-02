Welcome to ProTalk
==================

Welcome to the repository for [ProTalk](http://protalk.me), an online community resource providing a central point of access to audio/ video content with a PHP focus.

Contribute
----------

ProTalk is an open-source project and we welcome contributions from developers of all skills levels.  

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

####URLs

You can view the development version ProTalk or PHPMyAdmin in your browser using the following:

	http://33.33.33.10
	http://33.33.33.10/phpmyadmin         // login credentials are protalk / secret

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

###<a id="manual"></a>Manual Installation

1. Fork the protalk repository
2. Use git clone to get your fork on your local machine
3. Run the "bin/vendors install" command in the root directory of your installation
4. Make sure the app/cache and app/logs directories are writable by the webserver
5. Create the database and change the parameters.ini in app/config to set the database connection details
6. Run the command "app/console doctrine:schema:create" to create the database tables
7. Import the doc/db/seed_data.sql in your database for initial data
8. Creating a admin user for the backend can be done by running this command: "app/console fos:user:create admin admin@example.com password --super-admin