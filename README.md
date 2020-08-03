## Welcome !

## About LaVue CMS

<3 LaVue its base cms for blog type apps

Technologies:

-   Laravel 6
-   Vue 2
-   Vuex
-   Bootstrap

## Instalation

1. Insall dependency

-   cd /LaVue
-   composer install
-   npm install


1. Create and set Database

-   cp .env.evxample .env

-   create mysql db

-   Fill .env file with your data
     *   DB_CONNECTION=mysql
     *   DB_HOST=127.0.0.1
     *   DB_PORT=3306
     *   DB_DATABASE=db_name
     *   DB_USERNAME=db_user
     *   DB_PASSWORD=db_pw

## Seeding Database
* cd /Lavue
* php artisan db:seed

## Runing server
* php artisan serv
  
## Watch files changes 
* npm run watch (live watching)
* npm run dev (not optimized)
* npm run prod (optimized files)

## Debuging 
* Toogle Debugbar by changing .env file DEBUG=true/false 

## Testing 

* Backend: 
  * Start php unit test's:
  * ./vendor/bin/phpunit 

* Frontend: 
  * Start Cypres e2e tests:
    * npm run test:unit 
  * Cypress e2e test:
    * npm run test:e2e
  * Cypress e2e test with GUI:
    * npm run test:e2e:gui


## Url's
- localhost:8000 (Frontend)
- localhost:8000/panel (Dashboard)
- user:  admin@lavue-cms.com
- password: secret 



## License

LaVue cms is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
