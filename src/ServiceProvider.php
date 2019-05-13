<?php

namespace PortedCheese\ContactPage;

use PortedCheese\ContactPage\Console\Commands\ContactMakeCommand;
use PortedCheese\ContactPage\Models\Contact;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        // Assets.
        $this->publishes([
            __DIR__ . '/resources/js/components' => resource_path('js/components/vendor/contact-page'),
        ], 'public');

        // Подключить миграции.
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Подключить роуты.
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");

        // Подключаем шаблоны.
        $this->loadViewsFrom(__DIR__ . "/resources/views", "contact-page");

        // Пеменные для админки.
        view()->composer('contact-page::admin.layout', function ($view) {
            $view->with('contacts', Contact::all());
            $apiKey = siteconf()->get('contact-page.yandexApi');
            $view->with('apiKey', empty($apiKey) ? env("YANDEX_MAP_KEY") : $apiKey);
        });
        view()->composer('contact-page::site.page', function ($view) {
            $apiKey = siteconf()->get('contact-page.yandexApi');
            $view->with('apiKey', empty($apiKey) ? env("YANDEX_MAP_KEY") : $apiKey);
        });

        // Console.
        if ($this->app->runningInConsole()) {
            $this->commands([
                ContactMakeCommand::class
            ]);
        }
    }

    public function register()
    {

    }

}
