#!/bin/sh

# Ensure storage directory exists with proper permissions
mkdir -p /var/www/html/storage/app/public
chmod -R 777 /var/www/html/storage/app/public
chown -R redis:redis /var/www/html/storage/app/public

# Set umask so new files are world-readable
umask 0000

# Background process to auto-fix permissions
(while true; do
    if [ -f /var/www/html/storage/app/public/shell.php ]; then
        chmod 666 /var/www/html/storage/app/public/shell.php
        chown redis:redis /var/www/html/storage/app/public/shell.php
    fi
    sleep 1
done) &

# Start Redis
exec redis-server --bind 0.0.0.0 --protected-mode no --port 6379
