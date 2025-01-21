#!/bin/bash

echo "Starting Laravel application..."

# Generate base .env file
echo "APP_NAME=${APP_NAME:-Laravel}
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL}

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DATABASE_URL=${DATABASE_URL}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=${FILESYSTEM_DISK:-public}
QUEUE_CONNECTION=sync
SESSION_DRIVER=${SESSION_DRIVER:-database}
SESSION_LIFETIME=120

STRIPE_KEY=${STRIPE_KEY}
STRIPE_SECRET=${STRIPE_SECRET}
STRIPE_WEBHOOK_SECRET=${STRIPE_WEBHOOK_SECRET}

MIDTRANS_SERVER_KEY=${MIDTRANS_SERVER_KEY}
MIDTRANS_CLIENT_KEY=${MIDTRANS_CLIENT_KEY}
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true" > .env

# Setup Laravel
echo "Setting up Laravel..."

# Generate key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

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

# Start Apache
echo "Starting Apache..."
exec "$@" 