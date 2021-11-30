# Aplikasi (POS) poin of sale web php codeigniter
Aplikasi penjualan berbasis web mempermudah pengusaha memantau penjualan harian/bulanan, stok barang, laba/rugi dan laporan-laporan. Dibuat dengan Codeigniter, MySQL, dan Bootstrap

# Cara Install

## Clonning repository

```bash
git clone https://github.com/danangkonang/aplication-poin-of-sale-web-php-codeigniter.git pos

cd pos
cp .env.example .env
```

## Composer

kalau sudah memiliki coposer silahkan install vendor seperti biasanya dan skip langkah ini 

```php
wget "https://raw.githubusercontent.com/composer/getcomposer.org/main/web/installer"

php installer

php composer.phar install
```

## Database
Bisa juga menggunakan xampp, lamp, dll. sesuaikan config .env
```
docker-compose up --build -d
```

## Migrasi database

```bash
vendor/bin/phinx migrate -e development

vendor/bin/phinx seed:run
```

## Testing

```php
php -S localhost:8080
```

Akses http://localhost:8080 di browser

Happy Coding

<!-- danangkonang21@gmail.com -->
