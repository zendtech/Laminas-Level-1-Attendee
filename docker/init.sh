#!/usr/bin/env bash
# Usage: phpmyadmin_install.sh VERSION

echo "Installing Composer ..."
cd /tmp
wget https://getcomposer.org/composer.phar
mv /tmp/composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

echo "Installing Guestbook ..."
cd /home/guestbook
composer install

echo "Installing Onlinemarket Complete ..."
cd /home/onlinemarket.complete
composer install

echo "Setting up Apache ..."
echo "ServerName laminas" >> /etc/httpd/httpd.conf
ln -s /home/sandbox/public /srv/www/sandbox && \
ln -s /home/guestbook/public /srv/www/guestbook && \
ln -s /home/onlinemarket.complete/public /srv/www/onlinemarket.complete

echo "Setting permissions ..."
chown apache:apache /srv/www && \
chgrp -R apache /home/*
chmod -R 775 /home/*

echo "Initializing MySQL, PHP-FPM and Apache ... "
/etc/init.d/mysql start
/etc/init.d/phpfpm start
/etc/init.d/httpd start

lfphp --mysql --phpfpm --apache
