# Set default path for Exec calls
Exec {
    path => [ '/bin/', '/sbin/' , '/usr/bin/', '/usr/sbin/' ]
}

import 'params.pp'

node default {
    include params
    include protalk
}
