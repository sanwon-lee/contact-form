FROM php:8.5.3-fpm

ARG UID=1000
ARG GID=1000
ARG USER_NAME=myuser
ARG GROUP_NAME=myuser

COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g ${GID} ${GROUP_NAME} \
  && useradd -u ${UID} -g ${GROUP_NAME} -s /bin/bash -m ${USER_NAME}

WORKDIR /var/www

RUN chown -R ${USER_NAME}:${GROUP_NAME} /var/www

USER ${USER_NAME}