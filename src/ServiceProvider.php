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
            $collection = Contact::query()
                ->select("id", "title")
                ->orderBy("weight")
                ->get();
            $contacts = [];
            foreach ($collection as $item) {
                $contacts[] = [
                    "id" => $item->id,
                    "name" => $item->title,
                    "url" => route("admin.contact.show", ['contact' => $item]),
                ];
            }
            $view->with('contacts', $contacts);
            $view->with('apiKey', siteconf()->get('contact-page', "yandexApi"));
        });
        view()->composer("contact-page::site.map", function ($view) {
            $view->with('apiKey', siteconf()->get('contact-page', "yandexApi"));

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
