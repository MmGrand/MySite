
# MmGrandSiteLaravel

## Оглавление

- [О проекте](#о-проекте)
- [Используемые технологии](#используемые-технологии)
- [Установка](#установка)
- [Контакты](#контакты)

## О проекте

Проект реализован мной для личного использования и тренировки в разработке. В будущем можно изменить стили и выложить его на хостинг как сайт-портфолио. 

Публичная часть — отдельное Vue SPA, использующее Laravel API на том же домене. Проект включает авторизацию пользователей и мини-профиль. Пользователи могут оставлять комментарии под постами. На главной странице отображаются проекты и посты; их можно фильтровать по тегам и категориям. Также есть страницы «Контакты» и «Обо мне».

## Используемые технологии

- **PHP:** 8.2 или новее.
- **Laravel:** Фреймворк для разработки веб-приложений на PHP.
- **MySQL:** Система управления базами данных для хранения информации.
- **Vue 3 и Vue Router:** публичный интерфейс и клиентская маршрутизация.
- **Vite:** сборка и сервер разработки SPA.
- **Laravel Sanctum:** сессионная авторизация SPA и защита CSRF.
- **npm:** Менеджер пакетов для JavaScript.
- **JavaScript:** язык клиентского приложения.

## Установка

### Разработка через Docker Compose

Для разработки достаточно Docker Desktop с Docker Compose; PHP, Composer, Node.js и MySQL на хосте не нужны.

1. Создайте локальный `.env`, не перезаписывая существующий:
   ```powershell
   if (-not (Test-Path .env)) { Copy-Item .env.example .env }
   ```
   Сгенерируйте случайный `APP_KEY` и вставьте его в `.env`:
   ```sh
   docker run --rm php:8.3-cli-bookworm php -r "echo 'base64:'.base64_encode(random_bytes(32)).PHP_EOL;"
   ```
2. Соберите и запустите сервисы:
   ```sh
   docker compose up -d --build
   docker compose exec app php artisan migrate
   ```
   Исходники монтируются в PHP и Nginx, зависимости Composer и npm устанавливаются в контейнерах. Vite работает отдельно, сайт и API доступны на одном origin.
3. Откройте `http://localhost:8080`. Письма для локальной проверки доступны в Mailpit: `http://localhost:8025`.

Порты можно изменить переменными `APP_PORT`, `DB_FORWARD_PORT` и `VITE_PORT` в `.env`; веб-приложение, MySQL, Vite и Mailpit опубликованы только на loopback-интерфейсе. Подключиться к MySQL из контейнеров можно по имени `mysql`; порт БД не доступен извне компьютера.

Обычные команды Laravel запускайте через `docker compose exec app php artisan ...`, например `docker compose exec app php artisan migrate`. Для проверки логов: `docker compose logs -f app web mysql`. Остановка `docker compose down` сохраняет данные; `docker compose down -v` удаляет тома базы и загруженных файлов.

### Production

Production использует отдельный [docker-compose.prod.yml](./docker-compose.prod.yml): собранный образ приложения без исходников на хосте, PHP-FPM за Nginx, HTTPS, MySQL без опубликованного порта, постоянные тома и отдельный секрет root-пароля MySQL. Нужны сервер с Docker Compose, DNS-запись домена, TLS-сертификат и его приватный ключ.

1. Создайте production-файл окружения:
   ```sh
   cp .env.production.example .env.production
   ```
   Заполните домен в `APP_URL`, `SERVER_NAME` и `SANCTUM_STATEFUL_DOMAINS`; укажите в `TLS_CERT_DIR` корневой каталог сертификатов, например `/etc/letsencrypt`. Внутри него должны быть доступны `live/<домен>/fullchain.pem` и `live/<домен>/privkey.pem`. Монтируйте весь каталог, чтобы относительные ссылки Certbot из `live` могли разрешиться в `archive`. `APP_URL` и `SERVER_NAME` должны указывать на один домен. Nginx работает с UID 101: предоставьте этому UID доступ на чтение к приватному ключу через группу/ACL или защищённую deploy-копию, не делая ключ общедоступным; сохраняйте эти права при продлении сертификата. Каталог монтируется только для чтения.
2. Создайте отдельный секрет для root-пользователя MySQL, не добавляя его в `.env.production` или Git:
   ```sh
   mkdir -p secrets
   openssl rand -hex 32 > secrets/mysql_root_password
   chmod 600 secrets/mysql_root_password
   ```
   В PowerShell создайте файл без завершающего перевода строки:
   ```powershell
   New-Item -ItemType Directory -Force secrets
   docker run --rm php:8.3-cli-bookworm php -r "echo bin2hex(random_bytes(32));" | Set-Content -NoNewline -Encoding ascii secrets/mysql_root_password
   ```
3. Сгенерируйте случайный `APP_KEY` и `DB_PASSWORD`, вставьте их в `.env.production`. Например, PHP доступен без установки на хост через Docker:
   ```sh
   docker run --rm php:8.3-cli-bookworm php -r "echo 'base64:'.base64_encode(random_bytes(32)).PHP_EOL;"
   docker run --rm php:8.3-cli-bookworm php -r "echo bin2hex(random_bytes(32)).PHP_EOL;"
   ```
   Первая команда генерирует `APP_KEY`, вторая — пароль приложения для базы данных. Задайте реальные SMTP-параметры, если сайту нужна отправка почты.
4. Соберите и запустите production:
   ```sh
   docker compose --env-file .env.production -f docker-compose.prod.yml up -d --build
   docker compose --env-file .env.production -f docker-compose.prod.yml exec app php artisan migrate --force
   ```
   Не запускайте сидеры автоматически на боевой базе. Откройте входящие порты 80/443 в firewall; MySQL не публикуется. HTTP перенаправляется на HTTPS, а запросы с неожиданным Host отклоняются.

PHP-FPM и Nginx работают с read-only root filesystem, без Linux capabilities и с `no-new-privileges`; оба процесса непривилегированные. MySQL также использует read-only root filesystem, отбрасывает capabilities `NET_RAW` и `NET_BIND_SERVICE`, а его порт доступен только во внутренней сети Docker. Секреты и сертификаты не входят в образы. Регулярно обновляйте базовые образы, TLS-сертификат и зависимости; отдельно настраивайте резервное копирование томов `mysql_data` и `app_storage`. Не удаляйте эти тома при обновлении или развёртывании.

### SPA, авторизация и почта

- Исходники SPA и собственный lockfile находятся в `frontend`; production-сборка записывается в `public/spa`. Laravel отдаёт HTML-оболочку для известных адресов SPA и отдельные `/api/*` и `/sanctum/*`. Production Nginx отдаёт существующие файлы напрямую, а остальные запросы направляет в `public/index.php`.
- Установите `APP_URL` на реальный адрес сайта и при необходимости добавьте его хост и порт в `SANCTUM_STATEFUL_DOMAINS`. Сессия и CSRF-cookie должны использовать тот же домен, что и сайт; отдельный домен API в этой конфигурации не поддерживается. Production Compose принудительно включает HTTPS-only cookies.
- Восстановление пароля работает только через одноразовую ссылку из письма. Настройте `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, учётные данные и адрес отправителя (`MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME`) в `.env.production`. Без работающей почты пользователи не получат ссылку; `MAIL_MAILER=log` пригоден только для локальной разработки.
- SPA без SSR: динамический контент зависит от JavaScript и может индексироваться поисковиками иначе, чем прежние Blade-страницы.

## Контакты

Если у вас есть вопросы или предложения, вы можете связаться со мной по ссылкам в профиле.
