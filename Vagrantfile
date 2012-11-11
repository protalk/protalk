# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|
    # This vagrant will be running on centos 6.2, 64bit with puppet provisioning
    config.vm.box = 'centos-63-32-puppet'
    config.vm.box_url = 'https://dl.dropbox.com/sh/9rldlpj3cmdtntc/chqwU6EYaZ/centos-63-32bit-puppet.box'

    # Use :gui for showing a display for easy debugging of vagrant
    config.vm.boot_mode = :gui

    config.vm.define :protalk do |protalk_config|
        protalk_config.vm.host_name = "www.protalk.dev"

        protalk_config.vm.network :hostonly, "33.33.33.10"

        # Pass custom arguments to VBoxManage before booting VM
        protalk_config.vm.customize [
            'modifyvm', :id, '--chipset', 'ich9', # solves kernel panic issue on some host machines
            '--uartmode1', 'file', 'C:\\base6-console.log' # uncomment to change log location on Windows
        ]

        # Pass installation procedure over to Puppet (see `support/puppet/manifests/protalk.pp`)
        protalk_config.vm.provision :puppet do |puppet|
            puppet.manifests_path = "support/puppet/manifests"
            puppet.module_path = "support/puppet/modules"
            puppet.manifest_file = "protalk.pp"
            puppet.options = [
                '--verbose',
#                '--debug',
            ]
        end
    end
end
