#!/bin/sh
set -e

php bin/console doctrine:migrations:migrate -n

exec docker-php-entrypoint "$@"
