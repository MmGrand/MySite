#!/bin/sh
set -eu

php artisan config:cache
exec "$@"
