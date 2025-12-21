# Deployment Checklist

Na het pullen van nieuwe code op de server:

```bash
# 1. Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 2. Restart queue workers (if using)
php artisan queue:restart

# 3. Clear opcache (if enabled)
# Optie A: Via artisan (als je een custom command hebt)
php artisan opcache:clear

# Optie B: Via web request
curl https://restore.onlinehoster.nl/opcache-clear

# Optie C: Restart PHP-FPM
sudo systemctl restart php-fpm
# of
sudo systemctl restart php8.4-fpm

# 4. Rebuild assets (if changed)
npm run build
```

## Quick cache clear command:
```bash
php artisan optimize:clear
```
