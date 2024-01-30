# EXADS Challenge

Environment

- PHP v8.3.2
- Nginx Latest
- MySQL v8.3.0

To run the application on port 8080 on localhost(127.0.0.1), just run the command below in the folder where your project is

`docker compose up --build -d && docker compose exec php-service composer install`

`docker compose run php-service php bin/console.php app:prime`

# RUN composer install \
#     --no-interaction \
#     --no-plugins \
#     --no-scripts \
#     --prefer-dist
# RUN composer dump-autoload --optimize