# Init project

### 1. Start Docker containers
```
docker-compose up -d
```
### 2. Install PHP dependencies using Composer
```
docker exec -it test_task-php composer install
```
### 3. Run database migrations
```
docker exec -it test_task-php php artisan migrate
```
### 4. Seed the database with fake data
```
docker exec -it test_task-php php artisan db:seed --class=PostSeeder
```
