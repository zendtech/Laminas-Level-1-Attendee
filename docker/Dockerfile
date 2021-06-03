FROM asclinux/linuxforphp-8.2-ultimate:7.4-nts
MAINTAINER doug@unlikelysource.com
COPY index.html /srv/www/index.html
COPY zfcourse.sql /tmp/
COPY phpmyadmin_install.sh /tmp/
COPY init.sh /tmp/
COPY reset_perms.sh /tmp/
COPY httpd-laminas-1.conf /etc/httpd/extra
RUN \
    echo "Installing Composer ..." && \
    cd /tmp && \
    wget https://getcomposer.org/composer.phar && \
    mv /tmp/composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer
RUN \
    echo "Creating sample database and assigning permissions ..." && \
    /etc/init.d/mysql start && \
    sleep 5 && \
    mysql -uroot -v -e "CREATE DATABASE zfcourse;" && \
    mysql -uroot -v -e "CREATE USER 'laminas'@'localhost' IDENTIFIED BY 'password';" && \
    mysql -uroot -v -e "GRANT ALL PRIVILEGES ON *.* TO 'laminas'@'localhost';" && \
    mysql -uroot -v -e "FLUSH PRIVILEGES;" && \
    echo "Restoring sample database ..." && \
    mysql -uroot -e "SOURCE /tmp/zfcourse.sql;" zfcourse
RUN \
    echo "Installing phpMyAdmin ..." && \
    chmod +x /tmp/*.sh && \
    /tmp/phpmyadmin_install.sh
RUN \
    echo "Installing Composer globally ..." && \
    cd /tmp && \
    rm -f composer.* && \
    rm -f /usr/bin/composer && \
    wget https://getcomposer.org/download/latest-stable/composer.phar && \
    mv composer.phar /usr/bin/composer && \
    chmod +x /usr/bin/composer
RUN \
    echo "Setting PHP for development ..." && \
    echo "error_reporting=E_ALL ^ E_DEPRECATED" >>/etc/php.ini && \
    echo "display_errors=on" >>/etc/php.ini && \
    /etc/init.d/php-fpm restart
CMD /tmp/init.sh
