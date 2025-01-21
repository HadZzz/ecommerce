#!/bin/bash

echo "Starting Laravel application..."

# Setup Laravel
echo "Setting up Laravel..."
php artisan key:generate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations if DATABASE_URL is set
if [ ! -z "$DATABASE_URL" ]; then
    echo "Running database migrations..."
    php artisan migrate --force
else
    echo "WARNING: DATABASE_URL is not set!"
fi

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize
php artisan optimize

# Start the application
echo "Starting server..."
php artisan serve --host=0.0.0.0 --port=8080 