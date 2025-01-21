#!/bin/bash

# Wait for MySQL to be ready
wait-for-it ${DB_HOST}:${DB_PORT} -t 60

# Generate application key
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link

# Start the application
php artisan serve --host=0.0.0.0 --port=8080 