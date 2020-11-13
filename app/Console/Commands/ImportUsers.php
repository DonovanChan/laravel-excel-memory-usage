<?php

namespace App\Console\Commands;

use App\Imports\UsersImport;
use App\Imports\UsersImportBatched;
use Illuminate\Console\Command;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:import
        {--b|batch : Batch reading and inserts} 
        {filePath : Path to output file}
        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from Excel';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $filePath = $this->argument('filePath');
        $importable = $this->option('batch') ? new UsersImportBatched() : new UsersImport();
        $importable->import($filePath);

        $this->info("Data imported from $filePath");
    }
}
