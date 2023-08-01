FROM lorisleiva/laravel-docker:8.2
EXPOSE 8000

COPY .  /var/www
RUN rm -f composer.lock
RUN composer install
RUN cp .env.example .env
RUN php artisan cache:clear
RUN php artisan config:cache
RUN php artisan key:generate
RUN php artisan jwt:secret


CMD php artisan --host=0.0.0.0 serve