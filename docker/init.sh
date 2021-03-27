#!/usr/bin/env bash
# Usage: phpmyadmin_install.sh VERSION

echo "Installing Guestbook ..."
cd /home/guestbook
composer install

echo "Installing Onlinemarket Complete ..."
cd /home/onlinemarket.complete
composer install

echo "Setting up Apache ..."
echo "ServerName laminas" >> /etc/httpd/httpd.conf
ln -f -s /home/sandbox/public /srv/www/sandbox
ln -f -s /home/guestbook/public /srv/www/guestbook
ln -f -s /home/onlinemarket.complete/public /srv/www/onlinemarket.complete

echo "Setting permissions ..."
chmod +x /tmp/*.sh
/tmp/reset_perms.sh

echo "Initializing MySQL, PHP-FPM and Apache ... "
/etc/init.d/mysql start
/etc/init.d/phpfpm start
/etc/init.d/httpd start

lfphp --mysql --phpfpm --apache
