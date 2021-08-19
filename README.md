# VestiApi

#### Requirements
- docker >= 19.03.12
- docker-compose >= 1.25.5
- git >= 2.20.1

#### Clone project
```sh
git clone git@github.com:anderson-matheus/vesti-api.git
```


#### Config .env
```sh
cd vesti-api/

sudo cp .env.example .env
```

### Update env vars
```sh
APP_URL=http://localhost:8000
APP_PORT=8000

DB_CONNECTION=mysql
DB_HOST=vesti_db
DB_PORT=3306
DB_DATABASE=vesti_api
DB_USERNAME=root
DB_PASSWORD=123456
```

#### Install project
```sh
docker-compose up -d
docker exec -it vesti_app sh
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan passport:install --force
php artisan optimize
php artisan storage:link
composer dump-autoload
php artisan test
php artisan serve --host=0.0.0.0
```

#### Application url
- [http://localhost:8000](http://localhost:8000)

### API Documentation
- import vesti-api.postman_collection.json file in postman