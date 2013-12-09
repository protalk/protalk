class protalk::symfony2 {

# Install / Update the vendors
    exec { "vendorupdate" :
        command => "/usr/bin/php /var/www/bin/composer.phar install --dev",
        cwd => "/var/www/",
        creates => "/var/www/vendor/twig",
        require => [ Package["php"], Package["git"] ],
        timeout => 0,
        tries => 10,
    }

# Setup parameters.yml if it does not exist yet
    file { "parameters.yml" :
        path => "/var/www/app/config/parameters.yml",
        source => '/var/www/app/config/parameters.yml-dist',
        replace => "no", # Don't update when file is present
        before => Exec["vendorupdate"],
    }

# Create our initial db
#    exec { "init_db" :
#        command => "/usr/bin/php /var/www/app/console doctrine:schema:create",
#        creates => "/tmp/.sf2seeded",
#        require => [ Exec["vendorupdate"], Class['mysql::server'], Exec["create-db"] ],
#    }

# Update the db structure
    exec { "update_db_struct" :
        command => "/usr/bin/php /var/www/app/console doctrine:schema:update --force",
        require => [ Exec["vendorupdate"], Class['mysql::server'] ],
    }

    exec { "seed_db" :
        command => "cat /var/www/doc/db/seed_data.sql | mysql -u${params::dbuser} -p${params::dbpass} ${params::dbname} && touch /tmp/.sf2seeded",
        creates => "/tmp/.sf2seeded",
        require => [ Exec["update_db_struct"] ],

    }

    $cachedirs = [ "/tmp/sf2cache", "/tmp/sf2cache/app", "/tmp/sf2cache/app/cache", "/tmp/sf2cache/app/logs", "/tmp/sf2cache/app/cache/dev", ]
    file { $cachedirs :
        ensure => "directory",
        owner => "vagrant",
        group => "vagrant",
        mode => 0777,
        before => Exec["vendorupdate"],
    }

}