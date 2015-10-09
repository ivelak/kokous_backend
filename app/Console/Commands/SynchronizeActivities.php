<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SynchronizeWithPOF;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SynchronizeActivities extends Command
{
     use DispatchesJobs;
    
     protected $syncwithpof;


     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pof:synchronize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes activities between POF-Backend and local database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SynchronizeWithPOF $pof)
    {
        parent::__construct();
        $this->syncwithpof = $pof;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->dispatch($this->syncwithpof);
        $this->info('Did a thing!');
    }
}
