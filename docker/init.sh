#!/usr/bin/env bash

echo "Installing Guestbook ..."
cd /home/guestbook
composer install

echo "Installing Onlinemarket Complete ..."
cd /home/onlinemarket.complete
composer install

echo "Setting permissions ..."
chmod +x /tmp/*.sh
/tmp/reset_perms.sh

echo "Initializing MySQL, PHP-FPM and Apache ... "
/etc/init.d/mysql start
/etc/init.d/php-fpm start
/etc/init.d/httpd start

lfphp --mysql --phpfpm --apache
