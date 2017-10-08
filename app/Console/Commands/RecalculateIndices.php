<?php

namespace App\Console\Commands;

use App\Index;
use Illuminate\Console\Command;

class RecalculateIndices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'indices:recalculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculates the indices';

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
        Index::recalculateAll();
    }
}
