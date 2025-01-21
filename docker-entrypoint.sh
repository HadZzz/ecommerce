#!/bin/bash

echo "Starting Laravel application..."

# No need to parse DATABASE_URL as Laravel can use it directly
echo "Database URL: $DATABASE_URL"

# Start the application
php artisan serve --host=0.0.0.0 --port=8080 