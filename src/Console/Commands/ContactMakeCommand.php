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
                                {--menu : Only config menu}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create contact config';

    /**
     * The models that need to be exported.
     * @var array
     */
    protected $models = [
        'Contact.stub' => 'Contact.php',
    ];

    protected $controllers = [
        "Admin" => [
            "ContactController",
        ],
        "Site" => [
            "ContactController",
        ],
    ];
    protected $packageName = "ContactPage";

    protected $configName = "contact-page";

    protected $configValues = [
        'customTheme' => null,
        'path' => 'contacts',
        'yandexApi' => null,
        'useOwnAdminRoutes' => false,
        'useOwnSiteRoutes' => false,
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

    protected $dir = __DIR__;

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
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->option('menu')) {
            $this->exportModels();

            $this->exportControllers("Admin");
            $this->exportControllers("Site");

            $this->makeVueIncludes('admin');
            $this->makeVueIncludes('app');
        }
        $this->makeMenu();
        $this->makeConfig();
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
            'route' => "admin.contact.index",
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
