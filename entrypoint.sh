#!/bin/sh
set -e

php bin/console doctrine:migrations:migrate -n

if [ "$APP_DEMO" = "true" ]; then
    php bin/console doctrine:fixtures:load -n
fi

exec docker-php-entrypoint "$@"
