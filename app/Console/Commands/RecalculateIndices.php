<?php

namespace App\Console\Commands;

use App\Models\Index;
use App\Services\IndexService;
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
     * @var IndexService
     */
    protected $indexService;

    /**
     * Create a new command instance.
     *
     * @param IndexService $indexService
     */
    public function __construct(IndexService $indexService)
    {
        parent::__construct();
        $this->indexService = $indexService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->indexService->recalculateAll();
    }
}
