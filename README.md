<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Cars brands REST API

## Docker usage
    - Clone repo
    - cp .env.example .env
    - Enter your database configs into .env file
    - sudo docker-compose up --build
    - docker exec laravel_app php artisan migrate --force
    - docker exec laravel_app php artisan test
    - localhost:8000/api/documentation to learn about api features

## Local usage
    - Clone repo
    - cp .env.example .env
    - Enter your created database configs into .env file or create database and then enter it
    - composer install
    - php artisan migrate
    - php artisan serve
