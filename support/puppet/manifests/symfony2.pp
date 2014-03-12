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

# Run migrations classes
    exec { "run_migrations" :
        command => "/usr/bin/php /var/www/app/console doctrine:migrations:migrate --no-interaction",
        require => [ Exec["vendorupdate"], Class['mysql::server'], Package['php5-dev'] ],
        before => [ Exec["load_fixtures"]]
    }

# Load data fixtures
    exec { "load_fixtures" :
        command => "/usr/bin/php /var/www/app/console doctrine:fixtures:load --fixtures=/var/www/src/Protalk/MediaBundle/Tests/Fixtures --fixtures=/var/www/src/Protalk/UserBundle/Tests/Fixtures --no-interaction"
    }

    $cachedirs = [ "/var/www/app", "/var/www/app/cache", "/var/www/app/logs", "/var/www/app/cache/dev" ]
    file { $cachedirs :
        ensure => "directory",
        owner => "vagrant",
        group => "vagrant",
        mode => 0777,
        before => Exec["vendorupdate"],
    }
}