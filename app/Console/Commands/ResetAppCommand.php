<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetAppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Resetting app...');
        Artisan::call('migrate:fresh --seed --force');
        $this->info('DB migrated and seeded!');

        Artisan::call('cache:clear');
        $this->info('Cache cleared!');

        Artisan::call('config:clear');
        $this->info('Config cleared!');

        // remove all files from storage/app/public except .gitignore
        $this->delTree(storage_path('app/public'), false);
        // check if folder exists
        if (file_exists(storage_path('app/livewire-tmp'))) {
            $this->delTree(storage_path('app/livewire-tmp'), false);
        }

        $this->info('Storage cleared!');
        $this->info('Resetting app... Done!');
    }

    public function delTree($dir, $deleteFolder = true)
    {
        $files = array_diff(scandir($dir), ['.', '..', '.gitignore']);

        foreach ($files as $file) {

            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");

        }

        if ($deleteFolder) {
            rmdir($dir);
        }
    }
}
