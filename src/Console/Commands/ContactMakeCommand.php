<?php

namespace PortedCheese\ContactPage\Console\Commands;

use App\Menu;
use App\MenuItem;
use Illuminate\Console\Command;
use PortedCheese\BaseSettings\Console\Commands\BaseConfigModelCommand;

class ContactMakeCommand extends BaseConfigModelCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contact-page
                                {--all : Run all}
                                {--menu : Config menu}
                                {--models : Export models}
                                {--controllers : Export controllers}
                                {--policies : Export and create rules}
                                {--only-default : Create default rules}
                                {--scss : Export scss}
                                {--vue : Export vue}
                                {--config : Make config}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create contact config';

    protected $packageName = "ContactPage";

    /**
     * The models that need to be exported.
     * @var array
     */
    protected $models = ['Contact'];

    protected $controllers = [
        "Admin" => [
            "ContactController",
        ],
        "Site" => [
            "ContactController",
        ],
    ];

    protected $configName = "contact-page";
    protected $configTitle = "Контакты";
    protected $configTemplate = "contact-page::admin.settings";
    protected $configValues = [
        'path' => 'contacts',
        'yandexApi' => false,
        "latitude" => "39.90092731952594",
        "longitude" => "59.21567389811249",
        "zoom" => 14,
    ];

    protected $vueFolder = "contact-page";
    protected $vueIncludes = [
        'admin' => [
            "contact-create" => "ContactCreateComponent",
        ],
        'app' => [
            "contact-map" => "ContactPageMap",
        ],
    ];

    protected $scssIncludes = [
        "app" => ["contact-teaser"],
    ];

    protected $dir = __DIR__;

    protected $ruleRules = [
        [
            "title" => "Контакты",
            "slug" => "contact",
            "policy" => "ContactPolicy",
        ],
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->configValues['yandexApi'] = env("YANDEX_MAP_KEY", "");
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $all = $this->option("all");

        if ($this->option("menu") || $all) {
            $this->makeMenu();
        }

        if ($this->option("models") || $all) {
            $this->exportModels();
        }

        if ($this->option("controllers") || $all) {
            $this->exportControllers("Admin");
            $this->exportControllers("Site");
        }

        if ($this->option("vue") || $all) {
            $this->makeVueIncludes('admin');
            $this->makeVueIncludes('app');
        }

        if ($this->option("config") || $all) {
            $this->makeConfig();
        }

        if ($this->option("policies") || $all) {
            $this->makeRules();
        }

        if ($this->option("scss") || $all) {
            $this->makeScssIncludes("app");
        }
    }

    protected function makeMenu()
    {
        try {
            $menu = Menu::where('key', 'admin')->firstOrFail();
        }
        catch (\Exception $e) {
            $this->error("Admin menu not found");
        }

        $title = "Контакты";
        $itemData = [
            'title' => $title,
            'route' => "",
            'template' => "contact-page::admin.menu",
            'url' => '#',
            'ico' => "far fa-address-card",
            'menu_id' => $menu->id,
        ];

        try {
            $menuItem = MenuItem::query()
                ->where('title', $title)
                ->where("menu_id", $menu->id)
                ->firstOrFail();
            $menuItem->update($itemData);
            $this->info("Элемент меню '$title' обновлен");
        }
        catch (\Exception $e) {
            $menuItem = MenuItem::create($itemData);
            $this->info("Элемент меню '$title' создан");
        }
    }
}
