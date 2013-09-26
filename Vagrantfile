# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|
    # This vagrant will be running on centos 6.4, 64bit with puppet provisioning
    config.vm.box = 'centos-64-64bit-puppetlabs'
    config.vm.box_url = 'http://puppet-vagrant-boxes.puppetlabs.com/centos-64-x64-vbox4210.box'

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
