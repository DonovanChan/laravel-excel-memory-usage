<?php

namespace App\Console\Commands;

use App\Exports\UsersExport;
use App\Exports\UsersFakeExport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ExportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:export 
        {--c|count= : Number of records to export}
        {--f|fake=true : True to use fake data}
        {filePath : Path to output file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export users to Excel';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $filePath = $this->argument('filePath');
        $exportable = $this->option('fake') ? new UsersFakeExport() : new UsersExport();
        if ($count = $this->option('count')) {
            $exportable->limit($count);
        }
        $exportable->store($filePath);

        $this->info('Data exported to ' . Storage::disk()->path($filePath));
    }
}
