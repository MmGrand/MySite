# MySite

MySite — сайт-портфолио с публичным каталогом проектов и публикаций. Серверная часть на Laravel отдаёт HTML-оболочку Vue SPA и JSON API; интерфейс и API работают на одном домене.

## Возможности

- Главная страница, страницы «Обо мне» и «Контакты», каталоги проектов и публикаций.
- Просмотр опубликованных публикаций, фильтрация по категории и тегу, постраничная навигация.
- Регистрация и вход, профиль с аватаром, комментарии и ответы на комментарии.
- Запрос сброса пароля по электронной почте.

Стек проекта: PHP 8.2+, Laravel 12, Laravel Sanctum, MySQL 8.4, Vue 3, Vue Router и Vite. В Docker-окружении используются PHP 8.3 и Node.js 22.

## Как запустить

Для локальной разработки нужен Docker с Compose. Команды ниже предназначены для PowerShell и выполняются из корня репозитория.

1. Создайте `.env` на основе примера, не заменяя существующий файл:

   ```powershell
   if (-not (Test-Path .env)) { Copy-Item .env.example .env }
   ```

2. Соберите образы и запустите сервисы:

   ```powershell
   docker compose up -d --build
   ```

   Compose запускает приложение Laravel, Nginx, MySQL, Vite и Mailpit. PHP-зависимости устанавливаются при первом запуске контейнера приложения, а зависимости SPA — при сборке образа Vite.

3. Получите ключ Laravel:

   ```powershell
   docker compose exec app php artisan key:generate --show
   ```

   Скопируйте выведенное значение в `.env` после `APP_KEY=`. Контейнер монтирует исходники только для чтения, поэтому команду `key:generate` без `--show` внутри контейнера использовать не нужно.

4. Создайте таблицы базы данных:

   ```powershell
   docker compose exec app php artisan migrate
   ```

Откройте сайт по адресу `http://localhost:8080`. Порт приложения задаётся `APP_PORT` в `.env`; интерфейс Mailpit для проверки писем доступен по адресу `http://localhost:8025`.

## Примеры API

Основные публичные запросы:

```text
GET /api/home
GET /api/posts?category=php&tag=laravel
GET /api/posts/{slug}
GET /api/projects?tag=vue
```

Список публикаций и проектов включает постраничную навигацию. Фильтры публикаций принимают `category` и `tag`, фильтр проектов — `tag`. API для регистрации и входа находится по адресам `POST /api/register` и `POST /api/login`; комментарии создаются запросом `POST /api/comments` для вошедшего пользователя.

Полный список маршрутов определён в [`routes/api.php`](routes/api.php) и [`routes/web.php`](routes/web.php).

## Структура проекта

- `app/` — модели, контроллеры, middleware и другие компоненты Laravel.
- `routes/` — маршруты HTML-оболочки SPA и JSON API.
- `database/migrations/`, `database/factories/`, `database/seeders/` — схема базы данных, фабрики и начальные данные.
- `frontend/src/` — SPA: страницы, компоненты, API-клиент и стили.
- `resources/views/` — Blade-шаблоны, включая оболочку SPA.
- `public/` — публичная точка входа и статические файлы; собранная SPA размещается в `public/spa/`.
- `docker/`, `Dockerfile`, `docker-compose.yml`, `docker-compose.prod.yml` — конфигурация контейнеров для разработки и production.
- `tests/` — PHPUnit-тесты; сценарии API находятся в `tests/Feature/SpaApiTest.php`.

## Лицензия

В `composer.json` указана лицензия MIT. Отдельного файла `LICENSE` в репозитории нет.
