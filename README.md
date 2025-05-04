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

## Прочитать перед тестированием приложения

Что бы убедиться, что Laravel использует актуальные данные, а не закешированные.
Для корректного тестирования при разработке и деплое приложения. С начало сбросить кеш и настроек фреймворка laravel командами  
php artisan config:clear  # Очищает кеш конфигурации.
php artisan view:clear    # Удаляет скомпилированные шаблоны Blade.
php artisan cache:clear   # Очищает весь кеш приложения.
php artisan route:clear   # Удаляет кеш маршрутов.

Можно использовать одну команду для сброса настроек вместо всех:
php artisan optimize:clear # выполнит все перечисленные выше очистки разом.

Затем командой:
php artisan migrate:fresh # очистить базу данных и начать с нуля.

Затем командой:
php artisan storage:link # настроить символичяескую ссылку для папки хранилища постеров
ls -l public             # проверка папки хранилища (в первой строке будет путь)

Приступить к тестированию приложения.
