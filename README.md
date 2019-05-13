# Contact page

Страница контакты с картой

## Установка

`composer require portedcheese\contact-page`

`php artisan migrate` - Таблицы для контактов.

`php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public` - компоненты VueJs.

`php artisan make:contact-page` - добавит конфиг для контактов.