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
    v1.4.12:
        Добавлен класс move-center_noscroll 
           - php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public --force
    v1.4.11:
        Добавлен шаблон site.includes.too-many для вывода в site.page
            - чтобы использовать новый шаблон, проверьте переопределение  site.page
    v1.4.9:
        Fix load on scroll 
            - php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public --force
    v1.4.8:
        Change map component - load on scroll:
            - php artisan vendor:publish --provider="PortedCheese\ContactPage\ServiceProvider" --tag=public --force
            - npm run 
    v1.4.7:
        - site.map:  loadByRequire=1
    v1.4.6: 
        - Model Contact: add addrees to baloon
    v1.4.5: 
        - VendorName
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