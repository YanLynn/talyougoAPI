## Status
- trail -> 0 
- paid -> 1

-- active user 
- active -> 1
- inactive -> 0

-- order table 
- cash_status (ငွေရှင်းပြီး 1 , ငွေမရှင်း 0)
- vip_customer ( vip 1 , normal 0 )
- 


-- seed and factory ( for db testing)
- php artisan db:seed --class=UserSeeder 
- php artisan db:seed --class=ProfileSeeder 
- php artisan db:seed --class=CityOfDeliSeeder 
- php artisan db:seed --class=OrderSeeder  


## Step 1: Install Composer

```bash
composer install
```

## Step 2: Update Database credentials in environmental file

Now open the `.env` file and change following:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

## Step 3: Install JWT package

In command line interface (CLI) enter following command:

```bash
composer require tymon/jwt-auth:dev-develop --prefer-source
```

## Step 4: Publish the vendor

```bash
php artisan vendor:publish
```

It will copy jwt.php file from `/vendor/tymon/jwt-auth/config/config.php` to `/config` directory.

## Step 5: Generate JWT secret key

Enter the following command:

```bash
php artisan jwt:secret
```

## Step 6 : env key Generate

```bash
php artisan key:generate
```

## Step 7 : DB Migrate

```bash
php artisan migrate
```
