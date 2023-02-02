## Курс на учебной платформе udemy.com : "Laravel 9, Vue 3 & Inertia Fullstack 2023"

----

🎫 [Сертификат об успешном прохождении курса.](https://www.udemy.com/certificate/UC-005208ce-5326-4bb4-a17b-4f5c3128b280/)

Создано SPA приложение "Агенства недвижимости" с возможностью
регистарции пользователя и верификации аккаунта чрезе
email сообщение.

Зарегистрированные пользователи могут
размещать объекты недвижимости в общей базе и добавлять
изображения к каждому объекту недвижимости.

Участники приложения могут предлагать ставки
на покупку размещенной недвижимости. Разработана подсистема оповещений при получениии
предложения на покупку недвижимости а владелец
объекта недвижимости может подтверждать сделку выбрав лучшее
предложение.

🐘 Стек: Php 8.2 Laravel 9, Vue 3, InerciaJs, Tailwind CSS, MariaDb


### Темы изученые на курсе
____

**In Laravel:**

* Routing, including optional parameters, route grouping
* Middleware
* Eloquent ORM
* Models, Migrations
* Seeding databases with fake data
* Database relations - creating, managing, you will learn how they work and how to use them effectively
* Authentication & authorization - registering users, signing in, user verification, limiting access, admin users
* Sending emails, and testing emails locally using **Mailtip**!
* Notifications - database & emails
* Pagination & Filtering
* Uploading Images!
* Forms and data validation

**In Vue:**

* All-new Composition API!
* Reactive data
* Computed properties
* Passing data using props!
* Emitting custom events
* Handling events
* Making requests
* Components & component slots
* Creating layouts
* File uploading using JavaScript
* For styling, we will learn the super popular Tailwind CSS! Tailwind is the de-facto standard in 2023!

### Установка проекта

Для развертывания проекта потребуется установленный
🐳 **docker** или же 🐋 **docker desktop** проект будет работать
как на Windows с поддержкой WSL2 так и на Linux машине.

Локальная разработка и тестирование проекта использует
легковесный [Laravel Sail](https://laravel.com/docs/9.x/sail)
для работы с docker контейнерами.

#### Настройка переменных окружения проекта

Создать файл настроект проекта

```shell
cp .env.example .env
```

и если нужно настроить переменные окружения в `.env` файле

#### Утановка зависимостей проекта через composer

Если на машине разработчика **не установлен** локально composer
то зависимости проекта можно установить так

```shell
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install
```

⚠ если же на машине разработчика установлен **composer** и **php**
то для начала необходимо установить зависимости
проекта выполнив команду

```shell
composer install
```

на этом подготовка к работе с Laravel Sail закончен.

### Запуск проекта

Чтобы запустить проект к docker контейнерах выполинть команду

```shell
./vendor/bin/sail up -d
```

дождать сборки контейнеров и их старта. Более подробную информацию
по набору команд можно узнать на сайте
[Laravel Sail](https://laravel.com/docs/9.x/sail)

##### Сборка фронт части

Собрать фронт командой

```shell
./vendor/bin/sail npm run build
```

##### Выполнить миграции и заплнить тестовыми данными проект

Запустить команду

```shell
./vendor/bin/sail artisan migrate --seed
```

Проект дступен на локальной машине по адресу
http://localhost/
для тестирования email сообщений доступен вэб интерфейс
**Mailpit** http://localhost:8025
