<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Suscribete si ves este mensaje';

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
     * @return int
     */
    public function handle()
    {
        $texto = date("Y-m-d h:i:s")." -- Hola soy Jesus";
        Storage::append("resultadocronjob.txt", $texto);
        return 0;
    }
}
