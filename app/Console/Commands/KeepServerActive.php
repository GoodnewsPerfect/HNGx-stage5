<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class KeepServerActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:keep-server-active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To prevent the server from close from inactivities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       echo 'keep server alive';
    }
}
