# Installation

* Install docker as per https://github.com/iamyojimbo/docker-nginx-php-fpm/
* Inside the PHP container, run `usermod -u 1000 www-data` as per this permissions issue: https://github.com/boot2docker/boot2docker/issues/587 