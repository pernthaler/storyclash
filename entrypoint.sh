#!/bin/sh
set -e

php bin/console doctrine:migrations:migrate -n

exec /usr/local/bin/docker-php-entrypoint "$@"
