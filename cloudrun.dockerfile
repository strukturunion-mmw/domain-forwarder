# Use ServerSideUp Production PHP/NGINX image
FROM serversideup/php:8.1-fpm-nginx

# Set ENV Parameters (Descriptions: https://github.com/serversideup/docker-php)
ENV PHP_DATE_TIMEZONE="Europe/Berlin"
ENV PHP_DISPLAY_ERRORS=Off
ENV PHP_MAX_EXECUTION_TIME="99"
ENV PHP_MEMORY_LIMIT ="256M"
ENV PHP_POST_MAX_SIZE="100M"
ENV PHP_UPLOAD_MAX_FILE_SIZE="100M"
ENV AUTORUN_ENABLED="false"

# Install PHP Imagemagick and GD
RUN apt-get update \
    && apt-get install -y --no-install-recommends php8.0-imagick \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && apt-get install php-gd 

# Set working directory
WORKDIR /var/www/html

# Copy Application code to /var/www/html as user 9999/9999
COPY --chown=9999:9999 ./src /var/www/html
COPY ./@secret_credentials/env.cloudrun /var/www/html/.env
RUN chmod 777 -R /var/www/html/storage/
