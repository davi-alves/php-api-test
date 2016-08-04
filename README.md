# PHP API Test

A PHP API made with Lumen to serve a ***/user*** endpoint 
for test porposes.

## Setup

1. Install [docker](https://www.docker.com/products/docker)
2. Run `./docker/setup.sh`
3. Access the [http://localhost/user](http://localhost/user)

## Project structure

- `.env` - app configuration
- `app/Users.php` - users model
- `app/Http/routes.php` - app routes
- `app/Http/Controllers` - app controllers
- `database/migrations` - app migrations scripts


## Things to improve

- BDD
- Coverage test
- More tests
- docker-compose
