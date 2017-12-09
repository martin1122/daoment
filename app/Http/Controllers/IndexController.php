<?php

namespace App\Http\Controllers;

use App\Models\Index;
use App\Services\IndexService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @var IndexService
     */
    protected $indexService;

    /**
     * IndexController constructor.
     * @param IndexService $indexService
     */
    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    /**
     * Get indices with history
     *
     * @return mixed
     */
    public function get()
    {
        return $this->indexService->get();
    }

    /**
     * @param Index $index
     * @return mixed
     */
    public function chart(Index $index, Request $request)
    {
        return $this->indexService->getChartData($index, $request->get('period', '-1 day'));
    }
}
