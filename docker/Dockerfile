FROM asclinux/linuxforphp-8.2-ultimate:7.4-nts
MAINTAINER doug@unlikelysource.com
COPY index.html /tmp/
COPY zfcourse.sql /tmp/
COPY phpmyadmin_install.sh /tmp/
COPY init.sh /tmp/
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
CMD /tmp/init.sh