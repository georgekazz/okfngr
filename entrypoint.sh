#!/bin/sh
set -e

echo "Starting OKFN Greece Laravel App..."

# ── Create .env from environment variables ──────────────
echo "Creating .env file..."
cat > /var/www/html/.env << EOF
APP_NAME="${APP_NAME:-OKFN Greece}"
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY:-}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=${DB_HOST:-db}
DB_PORT=3306
DB_DATABASE=${DB_DATABASE:-okfngr}
DB_USERNAME=${DB_USERNAME:-okfnuser}
DB_PASSWORD=${DB_PASSWORD:-okfnpass}

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

FILESYSTEM_DISK=public
EOF

# ── Clear ALL caches before anything else ───────────────
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# ── Generate key if missing ──────────────────────────────
CURRENT_KEY=$(grep "^APP_KEY=" /var/www/html/.env | cut -d'=' -f2)
if [ -z "$CURRENT_KEY" ]; then
    echo "Generating app key..."
    php artisan key:generate --force
    echo "App key generated!"
else
    echo "App key already set: ${CURRENT_KEY:0:20}..."
fi

# ── Wait for database ────────────────────────────────────
echo "Waiting for database connection..."
until php -r "new PDO('mysql:host=${DB_HOST:-db};port=3306;dbname=${DB_DATABASE:-okfngr}', '${DB_USERNAME:-okfnuser}', '${DB_PASSWORD:-okfnpass}');" 2>/dev/null; do
    echo "   Database not ready, retrying in 3s..."
    sleep 3
done
echo "Database connected!"

# ── Migrations & seeds ───────────────────────────────────
echo "Running migrations..."
php artisan migrate --force

echo "Seeding database..."
php artisan db:seed --force

# ── Storage ──────────────────────────────────────────────
echo "Creating storage symlink..."
php artisan storage:link || true

# ── Cache for production AFTER key is set ───────────────
if [ "$APP_ENV" = "production" ]; then
    echo "Caching for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# ── Permissions ──────────────────────────────────────────
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ── WordPress import ─────────────────────────────────────
if [ -f "/var/www/html/AllPosts-wordpress.xml" ]; then
    echo "Found AllPosts-wordpress.xml, running WordPress import..."
    php artisan import:wordpress-xml AllPosts-wordpress.xml
    echo "WordPress import done!"
else
    echo "No AllPosts-wordpress.xml found, skipping import."
fi

echo "App is ready!"
exec apache2-foreground