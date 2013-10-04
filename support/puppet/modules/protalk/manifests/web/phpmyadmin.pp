class protalk::web::phpmyadmin {

    # Install PHPMyAdmin on /phpmyadmin
    package { "phpMyAdmin" :
        ensure  => present
    }

    # Setup our own phpmyadmin configuration file
    file { "/etc/httpd/conf.d/phpMyAdmin.conf" :
        source  => "puppet:///modules/protalk/phpmyadmin.conf",
        owner   => "root",
        group   => "root",
        require => Package["phpMyAdmin"],
        notify  => Service["apache"],
    }

}
