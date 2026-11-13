#!/bin/sh
set -eu

server_name=${SERVER_NAME:-localhost}

case "$server_name" in
    ''|*[!A-Za-z0-9.-]*)
        echo "SERVER_NAME must be a single DNS hostname." >&2
        exit 1
        ;;
esac

mkdir -p /tmp/conf.d
sed "s/\${SERVER_NAME}/$server_name/g" \
    /etc/nginx/conf.d/default.conf.template > /tmp/conf.d/default.conf

exec nginx -c /etc/nginx/nginx.conf -g 'daemon off;'
