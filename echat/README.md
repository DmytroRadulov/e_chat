## Install

1. Install [docker](https://docs.docker.com/engine/install/)
2. Clone repo
4. Copy ```cp .env.example .env```

5. Run containers
```shell
docker compose -f docker-compose.yml  up -d
```

6. Download composer packages
```shell
docker exec -it laravel-laravel-1 composer install
```
7. Migrate
```shell
docker exec -it laravel-laravel-1 php artisan migrate
```
8. Seeder
```shell
docker exec -it laravel-laravel-1 php artisan db:seed
```

### Use
Web [http://localhost](http://localhost)

### Commands
#### Start containers
```shell
docker compose -f docker-compose.yml up -d
```

#### Enter to php-fpm container
```shell
docker exec -it laravel-laravel-1 bash
```

#### Restart containers
```shell
docker compose -f docker-compose.yml restart
```
