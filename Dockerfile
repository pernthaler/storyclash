FROM node:slim AS node
WORKDIR /app
COPY . .
RUN npm install
RUN npm run build

FROM composer:latest AS composer
WORKDIR /app
COPY api .
RUN composer install

FROM dunglas/frankenphp:alpine
#ENV APP_ENV=prod
RUN install-php-extensions pdo_pgsql
COPY --from=node /app/dist /var/www/html/app
COPY --from=composer /app .
COPY Caddyfile /etc/caddy
COPY entrypoint.sh .
RUN chmod +x entrypoint.sh
ENTRYPOINT [ "./entrypoint.sh" ]
CMD ["--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]
