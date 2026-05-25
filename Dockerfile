FROM php:8.2-fpm-alpine

# تثبيت حزم النظام وامتدادات PHP الضرورية لـ Symfony و MySQL
RUN apk update && apk add --no-cache \
    bash \
    git \
    unzip \
    libxml2-dev \
    icu-dev \
    oniguruma-dev \
    libpng-dev \
    && docker-php-ext-install pdo_mysql intl opcache gd

# جلب أداة Composer من الصورة الرسمية
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مسار العمل داخل الحاوية
WORKDIR /var/www/html

# نسخ ملفات المشروع بالكامل إلى الحاوية
COPY . .

# ضبط الصلاحيات المناسبة لـ Symfony
RUN chown -R www-data:www-data /var/www/html

USER www-data

EXPOSE 9000

CMD ["php-fpm"]