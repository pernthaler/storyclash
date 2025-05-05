#!/bin/sh
set -e

php bin/console doctrine:migrations:migrate -n
php bin/console doctrine:fixtures:load -n

exec docker-php-entrypoint "$@"
