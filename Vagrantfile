# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "packagist-ubuntu-14.04"
  config.vm.box_url = "http://opscode-vm-bento.s3.amazonaws.com/vagrant/virtualbox/opscode_ubuntu-14.04_chef-provisionerless.box"

  # SSH/network configuration
  config.ssh.forward_agent = true
  # config.ssh.pty = true
  config.vm.network :private_network, ip: "192.168.115.200"
  config.vm.network :forwarded_port, guest: 80,   host: 8000 # Application
  config.vm.network :forwarded_port, guest: 3306, host: 3306 # MySQL
  config.vm.network :forwarded_port, guest: 6379, host: 6379 # Redis

  config.vm.synced_folder ".", "/vagrant", id: "vagrant-root", :nfs => true

  config.vm.provider :virtualbox do |v|
    v.memory = 2048
    v.cpus = 2
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end

  config.omnibus.chef_version = :latest

  config.vm.provision :chef_solo do |chef|
    chef.add_recipe "packagist::default"
end
