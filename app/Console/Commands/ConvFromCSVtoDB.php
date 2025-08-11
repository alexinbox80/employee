<?php

namespace App\Console\Commands;

use App\Models\Division;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Status;
use App\Services\FileService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ConvFromCSVtoDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:conv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for convert data from CSV to DB';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $localPath = config('csv.conf.localPath');

        $progressBar = $this->output->createProgressBar(4);
        $progressBar->start();

        $fileName = config('csv.conf.division');
        $file = Storage::disk('private')->path($localPath . DIRECTORY_SEPARATOR . $fileName);
        FileService::convertProcess($file, new Division());

        $progressBar->advance();

        $fileName = config('csv.conf.status');
        $file = Storage::disk('private')->path($localPath . DIRECTORY_SEPARATOR . $fileName);
        FileService::convertProcess($file, new Status());

        $progressBar->advance();

        $fileName = config('csv.conf.employee');
        $file = Storage::disk('private')->path($localPath . DIRECTORY_SEPARATOR . $fileName);
        FileService::convertProcess($file, new Employee());

        $progressBar->advance();

        $fileName = config('csv.conf.schedule');
        $file = Storage::disk('private')->path($localPath . DIRECTORY_SEPARATOR . $fileName);
        FileService::convertProcess($file, new Schedule(), false);

        $progressBar->advance();
        $progressBar->finish();

        $this->info(PHP_EOL . 'Data from CSV to DB was successfully converted.' . PHP_EOL);
    }
}
