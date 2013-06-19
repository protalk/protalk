class protalk::symfony2 {

    # Install / Update the vendors
    exec { "vendorupdate" :
        command => "/usr/bin/php /vagrant/bin/composer.phar install --dev",
        cwd     => "/vagrant/",
        creates => "/vagrant/vendor/twig",
        require => [ Package["php"], Package["git"] ],
        timeout => 0,
        tries   => 10,
    }

    # Setup parameters.yml if it does not exist yet
    file { "parameters.yml" :
        path => "/vagrant/app/config/parameters.yml",
        source => '/vagrant/app/config/parameters.yml-dist',
        replace => "no",                    # Don't update when file is present
        before  => Exec["vendorupdate"],
    }

    # Create our initial db
    exec { "init_db" :
        command => "/usr/bin/php /vagrant/app/console doctrine:schema:create && touch /tmp/.init_db",
        creates => "/tmp/.init_db",
        require => [ Exec["vendorupdate"], Service["mysql"], Package["php-xml"], Exec["create-db"] ],
    }

    # Update the db structure
    exec { "update_db_struct" : 
        command => "/usr/bin/php /vagrant/app/console doctrine:schema:update",
        require => [ Exec["vendorupdate"], Service["mysql"], Package["php-xml"], 
            Exec["init_db"] ],
    }


    exec { "seed_db" :
        command => "cat /vagrant/doc/db/seed_data.sql | mysql -u${params::dbuser} -p${params::dbpass} ${params::dbname} && touch /tmp/.sf2seeded",
        creates => "/tmp/.sf2seeded",
        require => [ Exec["init_db"], Exec["update_db_struct"] ],

    }

    $cachedirs = [ "/tmp/sf2cache", "/tmp/sf2cache/app", "/tmp/sf2cache/app/cache", "/tmp/sf2cache/app/logs", "/tmp/sf2cache/app/cache/dev",  ]
    file { $cachedirs :
        ensure => "directory",
        owner => "vagrant",
        group => "vagrant",
        mode  => 0777,
        before => Exec["init_db"],
    }

}
