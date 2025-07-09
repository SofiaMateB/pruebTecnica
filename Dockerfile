FROM php:8.2-apache

ENV ACCEPT_EULA=Y
ENV DEBIAN_FRONTEND=noninteractive

# Paso 1: Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    gnupg2 \
    ca-certificates \
    curl \
    apt-transport-https \
    lsb-release \
    unixodbc \
    unixodbc-dev \
    libgssapi-krb5-2 \
    wget \
    && rm -rf /var/lib/apt/lists/*

# Paso 2: Agregar repositorio de Microsoft para SQL Server
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list

# Paso 3: Instalar los drivers ODBC y herramientas mssql
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y \
    msodbcsql18 \
    mssql-tools18 \
    && echo 'export PATH="$PATH:/opt/mssql-tools18/bin"' >> ~/.bashrc \
    && apt-get clean -y

# Paso 4: Instalar extensiones PHP para SQL Server
RUN pecl install pdo_sqlsrv sqlsrv \
    && docker-php-ext-enable pdo_sqlsrv sqlsrv

# Paso 5: Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Paso 6: Configuración Apache y Laravel
RUN a2enmod rewrite

# Paso 7: Copiar archivos del proyecto
COPY . /var/www/html
WORKDIR /var/www/html

# Paso 8: Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
