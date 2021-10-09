FROM asclinux/linuxforphp-8.2-ultimate:8.0-nts
MAINTAINER doug@unlikelysource.com
COPY index.html /srv/www/index.html
COPY zfcourse.sql /tmp/
COPY phpmyadmin_install.sh /tmp/
COPY init.sh /tmp/
COPY reset_perms.sh /tmp/
COPY init_apps.sh /tmp
COPY httpd-laminas-1.conf /etc/httpd/extra
RUN chmod +x /tmp/*.sh
RUN \
    echo "Installing Composer ..." && \
    cd /tmp && \
    rm -f composer.phar && \
    wget -O composer.phar https://getcomposer.org/composer.phar && \
    mv /tmp/composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer
RUN \
    echo "Configuring Apache ..." && \
    echo "ServerName laminas" >> /etc/httpd/httpd.conf && \
    echo "Include /etc/httpd/extra/httpd-laminas-1.conf" >> /etc/httpd/httpd.conf
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
    /tmp/phpmyadmin_install.sh 5.1.1
RUN \
    echo "Setting up development environment ..." && \
    echo "error_reporting=E_ALL ^ E_DEPRECATED" >>/etc/php.ini && \
    echo "display_errors=on" >>/etc/php.ini && \
    /etc/init.d/php-fpm restart && \
    ln -s /bin/lfphp-get /usr/bin/apt && \
    ln -s /bin/lfphp-get /usr/bin/apt-get
ENTRYPOINT /tmp/init.sh
