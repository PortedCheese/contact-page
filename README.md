# Contact page

Страница контактов с картой

## Установка
    php artisan migrate
    
    php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public --force

    php artisan make:contact-page {--all : Run all}
                                  {--menu : Config menu}
                                  {--models : Export models}
                                  {--controllers : Export controllers}
                                  {--policies : Export and create rules}
                                  {--only-default : Create default rules}
                                  {--scss : Export scss}
                                  {--vue : Export vue}
                                  {--config : Make config}
    
`CONTACT_PAGE_ZOOM_MAP` - зум для карты

