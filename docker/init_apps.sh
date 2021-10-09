#!/usr/bin/env bash

echo "Installing Guestbook ..."
cd /home/guestbook
composer install --ignore-platform-reqs

echo "Installing Onlinemarket Complete ..."
cd /home/onlinemarket.complete
composer install --ignore-platform-reqs

echo "Setting permissions ..."
chmod +x /tmp/*.sh
chown apache:apache /srv/www
chgrp -R apache /home/*
chmod -R 775 /home/*

echo "Initializing MySQL, PHP-FPM and Apache ... "
/etc/init.d/mysql start
/etc/init.d/php-fpm start
/etc/init.d/httpd start

