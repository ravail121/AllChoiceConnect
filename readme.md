Requirements for front-end:

1- Install composer (run this command: composer install) : run commands inside this path: teltik-frontend-template-prod
2- Generate key command (php artisan key:generate)
3- Inside .env file please add values for:
	-API_BASE_URL = -path to api(http://britex.pw/api)
	-API_KEY = api_key column of company table(this gets generated when admin creates new company).
4- In case it still does not work than run these permission commands.
    -Try 1
        sudo chgrp -R www-data storage bootstrap/cache
        sudo chmod -R ug+rwx storage bootstrap/cache
    -Try 2
        chmod -R 775 storage bootstrap/cache
    -Try 3
        chmod -R 777 storage bootstrap/cache

    Note: Should probably work with Try 1.

5. Start development server.

php artisan serve
