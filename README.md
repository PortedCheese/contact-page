# Contact page

Страница контакты с картой

## Установка

`composer require portedcheese\contact-page`

`php artisan migrate` - Таблицы для контактов.

`php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public --force` - компоненты VueJs.

`php artisan make:contact-page` - добавит конфиг и модели для контактов.

`php artisan override:contact-page
    {--admin : Scaffold admin}
    {--site : Scaffold site}` - создает каонтроллеры и роуты.