class protalk::sql {
    include mysql::server

#PROBABLY NOT KEEPING DROP DB YOU JUST PUT IT IN HERE BECAUSE SCHEMA CREATE IN SYMFONY2.PP FAILS IF DB ALREADY EXISTS
#    exec { 'drop-db':
 #           unless => "/usr/bin/mysql -u${params::dbuser} -p${params::dbpass} ${params::dbname}",
  #          command => "/usr/bin/mysql -e \"drop database ${params::dbname};\"",
   #         require => Class['mysql::server'],
    #    }

   # exec { 'create-db':
   #     unless => "/usr/bin/mysql -u${params::dbuser} -p${params::dbpass} ${params::dbname}",
   #    command => "/usr/bin/mysql -e \"create database ${params::dbname}; grant all on ${params::dbname}.* to ${params::dbuser}@localhost identified by '${params::dbpass}';\"",
   #     require => Class['mysql::server'],
   # }

}