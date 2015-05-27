#!/bin/bash

env='local' # tandard enviroment
while getopts ":e:" optname
do
    case "$optname" in
        "e")
            env=$OPTARG
        ;;
    esac
done

# if server
if [ "$env" != "local" ]; then
    echo "Aws server, download tar and prepare"
    aws s3 cp s3://auto-conf/ilac/$env/deploy.tar.bz2 deploy.tar.bz2 --region us-east-1
    tar xvfj deploy.tar.bz2
    rm deploy.tar.bz2
else
    echo "Not a aws server, do not download tar"
fi

#if ansible is not installed
if [ $(dpkg-query -W -f='${Status}' ansible 2>/dev/null | grep -c "ok installed") -eq 0 ];
then
    echo "Installing Ansible"
    sudo apt-add-repository -y ppa:ansible/ansible
    sudo apt-get update
    sudo apt-get install -y ansible
else
    echo "Ansible found"
fi

if [ "$env" = "local" ]; then
    cd /vagrant/
fi

ansible-playbook -i 127.0.0.1, -e env=$env provisioning/setup.yml
