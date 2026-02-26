#!/bin/sh
set -e

echo "Starting OKFN Greece Laravel App..."

echo "Waiting for database connection..."
until php -r "new PDO('mysql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');" 2>/dev/null; do
    echo "   Database not ready, retrying in 3s..."
    sleep 3
done
echo "Database connected!"

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:GENERATE_WITH_php_artisan_key_generate" ]; then
    echo "Generating app key..."
    php artisan key:generate --force
fi

echo "Running migrations..."
php artisan migrate --force

echo "Seeding database..."
php artisan db:seed --force
echo "Database seeded!"

echo "Creating storage symlink..."
php artisan storage:link || true

echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

if [ "$APP_ENV" = "production" ]; then
    echo "Caching for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

if [ -f "/var/www/html/AllPosts-wordpress.xml" ]; then
    echo "Found AllPosts-wordpress.xml, running WordPress import..."
    php artisan import:wordpress-xml AllPosts-wordpress.xml
    echo "WordPress import done!"
else
    echo "No AllPosts-wordpress.xml found, skipping import."
fi

echo "App is ready!"

exec apache2-foreground