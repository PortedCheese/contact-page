<?php

namespace PortedCheese\ContactPage;

use App\Contact;
use PortedCheese\ContactPage\Console\Commands\ContactMakeCommand;

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
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        // Подключаем шаблоны.
        $this->loadViewsFrom(__DIR__ . "/resources/views", "contact-page");

        // Пеменные.
        view()->composer('contact-page::admin.layout', function ($view) {
            $view->with('contacts', Contact::all()->sortBy("weight"));

            $apiKey = siteconf()->get('contact-page', "yandexApi");
            $view->with('apiKey', empty($apiKey) ? env("YANDEX_MAP_KEY") : $apiKey);
        });
        view()->composer("contact-page::site.map", function ($view) {
            $apiKey = siteconf()->get('contact-page', "yandexApi");
            $view->with('apiKey', empty($apiKey) ? env("YANDEX_MAP_KEY") : $apiKey);

            $coordinates = [];
            foreach (Contact::all()->sortBy("weight") as $item) {
                $coordinates[$item->id] = [
                    'id' => $item->id,
                    'coord' => [$item->longitude, $item->latitude],
                    'title' => $item->title,
                    'description' => $item->description,
                    'ico' => $item->ico,
                ];
            }
            $view->with("coordinates", $coordinates);
            $view->with("mapCenter", !empty($coordinates) ? reset($coordinates)['coord'] : []);
        });

        // Console.
        if ($this->app->runningInConsole()) {
            $this->commands([
                ContactMakeCommand::class,
            ]);
        }
    }

    public function register()
    {

    }

}
