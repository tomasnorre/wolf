FROM alpine
RUN apk update && apk upgrade && \
    apk add bash apache2 php7-apache2 curl ca-certificates openssl openssh git tzdata && \
    apk add php7 php7-phar php7-json php7-iconv php7-zlib php7-openssl php7-ftp php7-mcrypt && \
    apk add php7-mbstring php7-soap php7-gmp php7-pdo_odbc php7-dom php7-pdo php7-zip php7-mysqli && \
    apk add php7-sqlite3 php7-pdo_pgsql php7-bcmath php7-gd php7-odbc php7-pdo_mysql php7-pdo_sqlite && \
    apk add php7-gettext php7-xmlreader php7-xmlwriter php7-tokenizer php7-xmlrpc php7-bz2 php7-pdo_dblib && \
    apk add php7-curl php7-ctype php7-session php7-simplexml php7-redis php7-ldap && \
	rm -f /var/cache/apk/*

# Add Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN cp /usr/bin/php7 /usr/bin/php \
    && rm -f /var/cache/apk/*

# Add apache to run and configure
RUN mkdir /run/apache2 \
    && sed -i "s/#LoadModule\ rewrite_module/LoadModule\ rewrite_module/" /etc/apache2/httpd.conf \
    && sed -i "s/#LoadModule\ session_module/LoadModule\ session_module/" /etc/apache2/httpd.conf \
    && sed -i "s/#LoadModule\ session_cookie_module/LoadModule\ session_cookie_module/" /etc/apache2/httpd.conf \
    && sed -i "s/#LoadModule\ session_crypto_module/LoadModule\ session_crypto_module/" /etc/apache2/httpd.conf \
    && sed -i "s/#LoadModule\ deflate_module/LoadModule\ deflate_module/" /etc/apache2/httpd.conf \
    && sed -i "s#^DocumentRoot \".*#DocumentRoot \"/var/www/wirwolfen.de/app\"#g" /etc/apache2/httpd.conf \
    && sed -i "s#/var/www/localhost/htdocs#/var/www/wirwolfen.de/app#" /etc/apache2/httpd.conf \
    && sed -i "s#CustomLog logs/access.log combined#CustomLog /dev/stdout common#" /etc/apache2/httpd.conf \
    && sed -i "s#ErrorLog logs/error.log#ErrorLog /dev/stdout\nTransferLog /dev/stdout#" /etc/apache2/httpd.conf \
    && sed -i "s#Listen 80#Listen 8082#" /etc/apache2/httpd.conf \
    && sed -i "s#AllowOverride None#AllowOverride All#" /etc/apache2/httpd.conf \
    && printf "\n<Directory \"/app\">\n\tAllowOverride All\n</Directory>\n" >> /etc/apache2/httpd.conf

WORKDIR /var/www/wirwolfen.de
COPY . /var/www/wirwolfen.de
RUN chown -R apache:apache /var/www/wirwolfen.de/app /run/apache2 \
    && chmod -R ug+rwx /var/www/wirwolfen.de
USER apache
CMD httpd -D FOREGROUND
