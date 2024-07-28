<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLogs extends Command
{
    protected $signature = 'logs:clear';
    protected $description = 'Clear the log files';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $logFile = storage_path('logs/laravel.log');

        if (file_exists($logFile)) {
            file_put_contents($logFile, '');
            $this->info('Log file cleared successfully.');
        } else {
            $this->error('Log file does not exist.');
        }
    }
}
