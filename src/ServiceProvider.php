<?php

namespace PortedCheese\ContactPage;

use App\Contact;
use Illuminate\View\View;
use PortedCheese\ContactPage\Console\Commands\ContactMakeCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        $this->extendBlade();

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
        // Пеменные.
        view()->composer('contact-page::admin.layout', function (View $view) {
            list($collection, $contacts) = Contact::getForAdminPage();
            $view->with('contacts', $contacts);
            $view->with("collection", $collection);
            $view->with('apiKey', base_config()->get('contact-page', "yandexApi"));
        });

        view()->composer("contact-page::site.map", function (View $view) {
            list($collection, $coordinates) = Contact::getForSitePage();
            $view->with("coordinates", $coordinates);
            $view->with("mapCenter", !empty($coordinates) ? reset($coordinates)['coord'] : []);
            $view->with('apiKey', base_config()->get('contact-page', "yandexApi"));
        });
    }

    public function register()
    {

    }

}
