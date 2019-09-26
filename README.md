# Contact page

Страница контакты с картой

## Установка

`composer require portedcheese\contact-page`

`php artisan migrate` - Таблицы для контактов.

`php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public --force` - компоненты VueJs.

`php artisan make:contact-page {--all : Run all}
                               {--menu : Config menu}
                               {--models : Export models}
                               {--controllers : Export controllers}
                               {--vue : Export vue}
                               {--config : Make config}`
    
CONTACT_PAGE_ZOOM_MAP - зум для карты