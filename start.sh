#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT"

echo "Docker up"
docker compose up -d

echo "Composer (inside app container)"
docker compose exec app composer install --no-interaction --prefer-dist

echo "==> App key / migrate (за потреби)"
docker compose exec app php artisan migrate --force

docker compose exec app chmod -R 775 storage bootstrap/cache
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
echo "Project start — http://localhost:8000"
