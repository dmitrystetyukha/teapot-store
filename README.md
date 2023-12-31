# TEAPOT STORE

Тестовое задание.

## I. ТЗ

Создать сайт по продаже чайников по требованиям:

- Сайт должен уметь работать с БД (MySQL).
- На странице должно быть реализовано отображение/редактирование/удаление чайника через ajax (можно использовать js).
- В визуальном плане - причесать, чтобы не голая таблица была, но и сильно стараться над этим не стоит
- Обязательно backend должен быть на PHP
- Не разрешается использование фреймворков, кроме jquery

## Структура проекта

- `/docker/`

  - `docker-compose.yml` конфиг для быстрой сборки группы контейнеров
  - `/app/` - конфиг интерпретатора и Dockerfile
  - `/server/` - настройки веб-сервера NGINX, который слушает контейнер с интерпретатором по порту _:9000_
  - `/teapot-store_db` - DDL таблицы _`teapots`_

- `/src/`
  - `/app/`
    - `/entity/`
      - `TeaPot` - объектное представление записи в таблице _`teapots`_ в БД
    - `/model/`
      - `TeaPotModel` - реагирует на команды `TeapotUseCase` и вносит изменения в БД или получает из нее данные
    - `/usecase/`
      - `TeapotUseCase` - варианты использования системы
    - `/utils/`
      - `Encoder` - формирует response бэкенда в JSON-представление
    - `config.php` - файл конфигурации
  - `/static/`
    - `/js/`
      - `script.js` клиентская сторона: CRUD - запросы к бэкенду, генерация и обработка форм.
  - `index.php` точка входа в систему, роутинг.

## Usage

В директории `/docker/` перед запуском необходмио создать файл `.env` с содержимым:

```dotenv
DB_HOST=ваш-хост
DB_USER=ваш-пользователь-бд
DB_PASSWORD=пароль-вашего-вользователя
DB_NAME=название-бд
MYSQL_ROOT_PASSWORD=пароль-пользователя-root-для mysql
```

Перед сборкой необходимо воспользоваться `composer update`, чтобы установить сторонний роутер, прописанный в `composer.json`.

`composer dumpautoload` был выполнен, внутренние зависимости в папке `/vendor/`

Затем, перейдя в терминале в директорию `/docker/`, запустите `docker-compose up`. Проект будет дооступен по _:8080_
