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

### Versions
    v1.4.4: 
        - Обновлен перечень иконок в компоненте ContactInfoComponent
    v1.4.3: 
        - В тизер рбочего времени добавлено время обеда  
    v1.4.0:
        - Laravel 8
    v1.2.1:
        - Изменено добавление переменных в шаблоны в ServiceProvider
    
    v1.2.0:
        - Изменен шаблон меню для sb-admin
        
    v1.1.13:
        - Добавлено поле адрес
    Обновление:
        - php artisan migrate
        
    v1.1.6:
        - Запрос на список контактов вынесен в модель
        - Добавлен параметр point={id}, ставит выбранную точку в начало списка
        - В команду добавлен параметр --only-default для прав доступа
        - Переделаны шаблоны контактов, теперь три вида страницы
        - В команду добавлен параметр --scss
    Обновление:
        - php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public --force
        - php artisan make:contact-page --scss
    
    v1.1.5:
        - Добавлены права доступа, изменено меню
    Обновление:
        - php artisan make:contact-page --policies --menu