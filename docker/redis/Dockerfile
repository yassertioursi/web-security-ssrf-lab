FROM redis:6-alpine

# Install required packages
RUN apk add --no-cache bash busybox-suid dcron

# Make crontabs directory writable by redis user
RUN mkdir -p /var/spool/cron/crontabs && \
    chown -R redis:redis /var/spool/cron/crontabs && \
    chmod -R 777 /var/spool/cron/crontabs

# Allow redis to write to /var/www/html for webshell
RUN mkdir -p /var/www/html/storage/app/public && \
    chown -R redis:redis /var/www/html && \
    chmod -R 777 /var/www/html

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Run Redis with entrypoint that handles permissions
ENTRYPOINT ["/entrypoint.sh"]

