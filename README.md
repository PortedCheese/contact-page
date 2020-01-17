# Contact page

Страница контакты с картой

## Установка
    php artisan migrate
    
    php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public --force

    php artisan make:contact-page {--all : Run all}
                                  {--menu : Config menu}
                                  {--models : Export models}
                                  {--controllers : Export controllers}
                                  {--policies : Export and create rules}
                                  {--vue : Export vue}
                                  {--config : Make config}
    
`CONTACT_PAGE_ZOOM_MAP` - зум для карты

### Versions

    v1.1.5:
        - Добавлены права доступа, изменено меню
    Обновление:
        - php artisan make:contact-page --policies --menu