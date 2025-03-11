#!/bin/bash

export COMPOSER_ALLOW_SUPERUSER=1
echo 'memory_limit = 2048M' > /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

"
[opcache]
opcache.enable=1
opcache.enable_cli=1
opcache.revalidate_freq=0
opcache.validate_timestamps=1
opcache.max_accelerated_files=10000
opcache.memory_consumption=192
opcache.max_wasted_percentage=10
opcache.interned_strings_buffer=16
opcache.fast_shutdown=1
opcache.jit=1235
;opcache.jit_debug=1
opcache.jit_persistent = 1
opcache.jit_buffer_size=256M
opcache.jit_dumper = /var/www/var/log/jit_dumper.log
" > /usr/local/etc/php/conf.d/docker-php-opcache.ini;

echo "
[global]
; error_log = /proc/self/fd/2
error_log = /var/www/var/log/fpm-error.log

; https://github.com/docker-library/php/pull/725#issuecomment-443540114
log_limit = 8192

[www]
; php-fpm closes STDOUT on startup, so sending logs to /proc/self/fd/1 does not work.
; https://bugs.php.net/bug.php?id=73886
; access.log = /proc/self/fd/2
access.log = /var/www/var/log/fpm-access.log

clear_env = no

; Ensure worker stdout and stderr are sent to the main error log.
catch_workers_output = yes
decorate_workers_output = no

" > /usr/local/etc/php-fpm.d/docker.conf

# Download composer
if [ -f "/usr/local/bin/composer" ]
then
  composer self-update
else
  wget -c https://getcomposer.org/download/latest-stable/composer.phar
  chmod +x composer.phar
  mv composer.phar /usr/local/bin/composer
fi

RUN_OPTIMIZER=0
if [ ! -d "vendor" ]; then
  echo "Updating composer"
  RUN_OPTIMIZER=1
  composer install
  composer global require --dev rector/rector
fi

# Classmap
if [ $RUN_OPTIMIZER -ge 1 ]; then
  composer dump-autoload
fi

echo "" > var/log/jit_dumper.log
echo "" > var/log/emergency.log
echo "" > var/log/fpm-access.log
echo "" > var/log/fpm-error.log

# Set perms
chown -R www-data:www-data -R /var/www
chmod -R 775 var

#php bin/console doctrine:schema:update

echo "#########################################"
echo "############# Run supervisord ###########"
echo "#########################################"
supervisord -n -c /etc/supervisor/supervisord.conf

