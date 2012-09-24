class protalk::setup {

    # Install some default packages
    $default_packages = [ "mc", "strace", "sysstat", "git" ]
    package { $default_packages :
        ensure => present,
    }

    # Setup a EPEL repo, the default one is disabled.
    file { "EpelRepo" :
        path   => "/etc/yum.repos.d/epel.repo",
        source => "${params::filepath}/protalk/files/epel.repo",
        owner  => "root",
        group  => "root",
        mode  => 0644,
    }

}