<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DatabaseManagementStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:management';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Point Of The new Era';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('migrate --database=database_management --path=database/migrations/database_management');
    }
}
