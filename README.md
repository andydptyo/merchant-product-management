# Merchant Product Management
- Laravel 8
- VueJS (laravel/ui)

## How it works
`git clone https://github.com/andydptyo/merchant-product-management.git`

`cd merchant-product-management`

`composer install`

`yarn && yarn dev` or `npm install && npm run dev`

`cp .env.example .env`

open `.env` then edit `DB_DATABASE,DB_USERNAME,DB_PASSWORD` according to yours

`php artisan key:generate`

`php artisan migrate:fresh --seed`

`php artisan serve`

open `localhost:8000` in your browser

## Testing
open `.env.testing` then edit `DB_DATABASE,DB_USERNAME,DB_PASSWORD` according to yours

`php artisan test`
