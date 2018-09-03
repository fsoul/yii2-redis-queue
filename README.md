# Project Title

Yii2 Redis Queue MySql

## Need to be installed
1. PHP 7 with Curl extension
2. Apache/Nginx
3. MySQL
4. Redis

## Getting Started

Download or clone repository 
```
git clone https://github.com/fsoul/yii2-redis-queue
```

Set up two virtual hosts and set root folder for: 
``
path/to/yii2-redis-queue/backend/web
``

``
path/to/yii2-redis-queue/frontend/web
``

Add to hosts something like this:

``
127.0.0.1  backend.test
``

``  
127.0.0.1  frontend.test
``

### Setting up

In root folder:
```
php init
```
and choose ``0`` to set up development environment.

Then install dependencies with composer:
```
composer update
```

Install Redis (example for ubuntu) 
```
wget http://download.redis.io/redis-stable.tar.gz
tar xvzf redis-stable.tar.gz
cd redis-stable
make
```

Create mysql database and configure it in common/config/main-local.php
```
CREATE DATABASE yii2test;
```

Install migrations
```$xslt
php yii migrate
```

## Usage Examples

This command obtains and executes tasks in a loop until the queue is empty:
```$xslt
php yii queue/run
```

This command launches a daemon which infinitely queries the queue:
```$xslt
php yii queue/listen
```

Check queue status:
```$xslt
php yii queue/info
```

Clear queue:
```$xslt
php yii queue/clear
```

For emulate POST requests to API set up proper $url in curlPostRequest and run:
```
php curlPostRequest.php
```


## Authors

**Bilinskyi Vitalii**

## License

This project is licensed under the BSD License - see the [LICENSE.md](LICENSE.md) file for details
