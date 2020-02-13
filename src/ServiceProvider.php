<?php

namespace PortedCheese\ContactPage;

use App\Contact;
use Illuminate\Support\Facades\Schema;
use PortedCheese\ContactPage\Console\Commands\ContactMakeCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        if (class_exists(Contact::class) && Schema::hasTable("contacts")) {
            $this->extendBlade();
        }

        // Assets.
        $this->publishes([
            __DIR__ . '/resources/js/components' => resource_path('js/components/vendor/contact-page'),
            __DIR__ . '/resources/sass' => resource_path('sass/vendor'),
        ], 'public');

        // Подключить миграции.
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Подключить роуты.
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");
        $this->loadRoutesFrom(__DIR__ . "/routes/admin.php");

        // Подключаем шаблоны.
        $this->loadViewsFrom(__DIR__ . "/resources/views", "contact-page");

        // Console.
        if ($this->app->runningInConsole()) {
            $this->commands([
                ContactMakeCommand::class,
            ]);
        }
    }

    private function extendBlade()
    {
        $collection = Contact::getForPage();
        // Пеменные.
        view()->composer('contact-page::admin.layout', function ($view) use ($collection) {
            $contacts = [];
            foreach ($collection as $item) {
                $contacts[] = [
                    "id" => $item->id,
                    "name" => $item->title,
                    "url" => route("admin.contact.show", ['contact' => $item]),
                ];
            }
            $view->with('contacts', $contacts);
            $view->with("collection", $collection);
            $view->with('apiKey', siteconf()->get('contact-page', "yandexApi"));
        });

        view()->composer("contact-page::site.map", function ($view) use ($collection) {
            $view->with('apiKey', siteconf()->get('contact-page', "yandexApi"));

            $coordinates = [];
            foreach ($collection as $item) {
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
    }

    public function register()
    {

    }

}
