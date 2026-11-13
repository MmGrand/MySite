#!/bin/sh
set -eu

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction
fi

exec "$@"
