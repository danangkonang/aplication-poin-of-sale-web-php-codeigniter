# Aplikasi (POS) Poin Of Sale web php codeigniter
Aplikasi penjualan berbasis web Dibuat dengan Codeigniter, MySQL, dan Bootstrap.

## fitur
- login/registrasi
- seting hak akses user
- multi level
- member
- penjualan harian/bulanan
- stok barang
- barcode

# Installasi

## Clonning repository

```bash
git clone https://github.com/danangkonang/aplication-poin-of-sale-web-php-codeigniter.git aplikasi-kasir

cd aplikasi-kasir
cp .env.example .env
```

## Composer

kalau sudah memiliki coposer silahkan install vendor seperti biasanya dan skip langkah ini

```php
// wget "https://raw.githubusercontent.com/composer/getcomposer.org/main/web/installer"

// php installer

php composer.phar install
```

## Database

Bisa juga menggunakan xampp, lamp, dll. sesuaikan config .env

```
#start database
docker-compose up -d

#stop database
docker-compose down
```

## Migrasi database

```bash
vendor/bin/phinx migrate -e development

vendor/bin/phinx seed:run

vendor/bin/phinx rollback -e development -t 20210107020548
```

## Testing

```php
php -S localhost:8080
```

Akses http://localhost:8080 di browser

Happy Coding

<!-- danangkonang21@gmail.com -->
