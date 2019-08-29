<?php

namespace PortedCheese\ContactPage\Console\Commands;

use Illuminate\Console\Command;
use PortedCheese\BaseSettings\Console\Commands\BaseOverrideCommand;

class ContactOverrideCommand extends BaseOverrideCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'override:contact-page
                    {--admin : Scaffold admin}
                    {--site : Scaffold site}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create contact config';

    protected $controllers = [
        'Admin' => ["ContactController"],
        'Site' => ["ContactController"],
    ];

    protected $packageName = "ContactPage";

    protected $dir = __DIR__;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->error("Disabled");
        if ($this->option('admin') && false) {
            $this->createControllers("Admin");
            $this->expandSiteRoutes('admin');
        }

        if ($this->option('site') && false) {
            $this->createControllers("Site");
            $this->expandSiteRoutes('web');
        }
    }
}
