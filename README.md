# Backend Laravel

## Инструкции

## 1. Склонируйте проект в директорию с сервером XAMPP

## 2. Данные хранятся в БД MySQL. Создайте пустой файл ".env" , скопируйте в него содержимое файла ".env.example"

## 3. По умолчанию порт БД 3306 , название БД "laravel_b"

## 4. По умолчанию порт server 80 в XAMPP

## 5. Настроить виртуальный хост в XAMPP файле httpd-vhosts.conf

## конфигурация Apache

```apache
 <VirtualHost *:80>
    ##ServerAdmin webmaster@dummy-host.example.com
    DocumentRoot "C:/xampp/htdocs/fs_diplom_backend/public"
    ServerName 127.0.0.1
    ##ServerAlias www.dummy-host.example.com
    ##ErrorLog "logs/dummy-host.example.com-error.log"
    ##CustomLog "logs/dummy-host.example.com-access.log" common
</VirtualHost>
```

## 5. Для запуска пакетного файла/проекта "fs_diplom_backend" выполнить

## composer install

## php arisan key:generate

## php artisan migrate

## запустить сервер Apache

## запустить MySQL
