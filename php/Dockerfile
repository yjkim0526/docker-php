FROM php:8.2-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql 

# 최고 권한으로 컴포즈 실행할수 있도록 권한 부여
ENV COMPOSE_ALLOW_SUPERUSER = 1

# 도커 허브 composer:2.7를 가져오고 (/user/bin/composer) 위치의 파일을 가져와 /usr/bin/composer에 복사
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
