#!/usr/bin/env bash
# Usage: phpmyadmin_install.sh VERSION

echo "Installing Composer ..."
cd /tmp
chmod +x *.sh
wget https://getcomposer.org/composer.phar
mv /tmp/composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

echo "Installing Guestbook ..."
cd /home/guestbook
wget https://getcomposer.org/download/1.10.20/composer.phar
php composer.phar install
php composer.phar development-enable

echo "Installing Onlinemarket Complete ..."
cd /home/onlinemarket.complete
wget https://getcomposer.org/download/1.10.20/composer.phar
php composer.phar install
php composer.phar development-enable
mkdir public/captcha

echo "Setting up Apache ..."
echo "ServerName laminas" >> /etc/httpd/httpd.conf
cp /tmp/index.html /srv/www
chgrp -R apache /home/*
chmod -R 775 /home/*
ln -s /home/guestbook/public /srv/www/guestbook
ln -s /home/onlinemarket.complete/public /srv/www/onlinemarket.complete
ln -s /home/sandbox/public /srv/www/sandbox
ln -s /srv/phpmyadmin /srv/www/phpmyadmin

echo "Initializing MySQL, PHP-FPM and Apache ... "
/etc/init.d/mysql start
/etc/init.d/phpfpm start
/etc/init.d/httpd start

lfphp --mysql --phpfpm --apache
