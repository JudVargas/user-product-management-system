FROM php:8.3-cli

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libxml2-dev \
    libonig-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    postgresql-client \
    libpq-dev \
    && docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Carpeta de trabajo estándar
WORKDIR /var/www

# Exponer puerto
EXPOSE 8000

# Comando base (simple y limpio)
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]