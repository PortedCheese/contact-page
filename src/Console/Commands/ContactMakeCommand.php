<?php

namespace PortedCheese\ContactPage\Console\Commands;

use Illuminate\Console\Command;

class ContactMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contact-page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create contact config';

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
        $this->makeConfig();
    }

    protected function makeConfig()
    {
        $config = siteconf()->get('contact-page');
        if (!empty($config)) {
            if (! $this->confirm("Contact page config already exists. Replace it?")) {
                return;
            }
        }

        siteconf()->save("contact-page", [
            'customTheme' => null,
            'path' => 'contacts',
            'yandexApi' => env("YANDEX_MAP_KEY", ""),
        ]);

        $this->info("Config added to siteconfig");
    }
}
