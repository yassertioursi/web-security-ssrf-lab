#!/bin/sh

# Run as root initially to fix permissions
if [ "$(id -u)" = "0" ]; then
    echo "[*] Running as root - fixing permissions..."

    # Ensure storage directory exists with proper permissions
    mkdir -p /var/www/html/storage/app/public
    chmod -R 777 /var/www/html/storage/app/public
    chown -R redis:redis /var/www/html/storage/app/public

    # Fix /data permissions
    mkdir -p /data
    chown -R redis:redis /data
    chmod -R 777 /data

    echo "[*] Permissions fixed"

    # Drop privileges to redis user and re-execute this script
    exec su-exec redis "$0" "$@"
fi

# Now running as redis user
echo "[*] Running as redis user ($(id))"

# Set umask so new files are world-readable
umask 0000

# Start Redis server with custom config
exec redis-server /etc/redis/redis.conf --bind 0.0.0.0 --protected-mode no --port 6379 --dir /var/www/html/storage/app/public
