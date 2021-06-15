## Environment
- Nginx: 1.12
- PHP: 7.2
- MySql: 5.7
- OS: Centos 7
- Laravel Framework: 6.6.0

## Install guide

- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan storage:link`
- Config .env && Create migration table in database:
    ``php artisan migrate --seed``
- Setting cron job:
    ``* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1``
- Run laravel mix:
    `npm install`
    `npm run dev (If you debug)`
    `npm run prod (If you want min file)`
