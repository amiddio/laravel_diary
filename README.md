# Diary

## Описание

Тестовый проект для обучения и тестирования возможностей Laravel

## Стек технологий

Docker, Apache2, PHP 8.1, Laravel 10, MySql 8, Mailhog, Redis, Node.js, Npm, Bootstrap

## Сторонние пакеты

* barryvdh/laravel-debugbar
* barryvdh/laravel-ide-helper

## Описание функционала и модулей

### Пользователи

Интеграция в проект всего функционала модели User из коробки:
регистрация, вход, смена пароля, подтверждение email и т.д.

### Личный кабинет

Личный кабинет (далее ЛК) доступен после регистрации и успешной аутентификации пользователей.
После входя в ЛК, пользователь может менять свои персональные данные, такие как имя и email.
Добавлять аватар. Менять пароль. А также удалить свой аккаунт.

Через ЛК можно управлять своим дневником и вести общедоступный блог.

### Дневник

У каждого пользователя, в ЛК есть возможность вести дневник, доступ к которому закрыт извне.
К дневнику можно создавать категории, для удобной фильтрации своих записей.

### Блог

Проект позволяет пользователям везти блог.
В ЛК есть необходимый функционал для управления своими постами. Реализован функционал тэгирования записей.
Управление тэгами для постов блога также есть в ЛК пользователей.

На самом сайте выводятся опубликованные записи блога.
К каждой записи пользователи могут оставлять комментарии, и помечать их как Like/Dislike.

### Комментарии

Модуль Комментарии реализован как отдельная автономная сущность.
Используя полиморфные отношения, комментарии можно легко подключить к другим сущностям, таким как продукты, статьи,
новости и т.д.
На данный момент они связаны только с записями блога.

### Like/Dislike

Этот модуль также использует полиморфные отношения, и, следовательно, может подключаться к различным сущностям сайта.
На данный момент он используется в записях блога.

### Страница "Contact"

Эта страница обратной связи пользователей сайта, которые могут отсылать на email администратора свои вопросы и
пожелания.

Сама отправка email-а реализована в виде очереди, как отдельная отложенная задача.

## Screenshots

### Личный кабинет

![Screenshot_1](/screenshots/Screenshot_01.png)
![Screenshot_1](/screenshots/Screenshot_02.png)
![Screenshot_1](/screenshots/Screenshot_03.png)
![Screenshot_1](/screenshots/Screenshot_04.png)
![Screenshot_1](/screenshots/Screenshot_05.png)
![Screenshot_1](/screenshots/Screenshot_06.png)
![Screenshot_1](/screenshots/Screenshot_07.png)
![Screenshot_1](/screenshots/Screenshot_08.png)

### Front-end

![Screenshot_1](/screenshots/Screenshot_09.png)
![Screenshot_1](/screenshots/Screenshot_10.png)
![Screenshot_1](/screenshots/Screenshot_11.png)
