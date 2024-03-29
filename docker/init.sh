#!/usr/bin/env bash

if [[ ! -d /home/guestbook/vendor ]]; then
    /tmp/init_apps.sh
fi

echo "Setting permissions ..."
chmod +x /tmp/*.sh
chown apache:apache /srv/www
chgrp -R apache /home/*
chmod -R 775 /home/*

echo "Initializing MySQL, PHP-FPM and Apache ... "
/etc/init.d/mysql start
/etc/init.d/php-fpm start
/etc/init.d/httpd start

lfphp --mysql --phpfpm --apache >/dev/null 2&>1
