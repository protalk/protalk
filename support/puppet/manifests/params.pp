#
# Tweak these variables to adjust your development environment:
#
class params {
    # Hostname of the virtualbox (make sure this URL points to 127.0.0.1 on your local dev system!)
    $host = 'www.protalk.dev'

    # Original port (don't change)
    $port = '80'

    # Database names (must match your app/config/parameters.yml file)
    $dbname = 'protalk'
    $dbuser = 'protalk'
    $dbpass = 'secret'

    $filepath = '/vagrant/support/puppet/modules'


    $phpmyadmin = true
}
