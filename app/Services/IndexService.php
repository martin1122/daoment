<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.12.17
 * Time: 23:46
 */

namespace App\Services;

use App\Models\Index;
use Carbon\Carbon;

class IndexService
{
    /**
     * @var Index
     */
    protected $model;

    /**
     * IndexService constructor.
     * @param Index $index
     */
    public function __construct(Index $index)
    {
        $this->model = $index;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model->orderby('position', 'asc')->withCount('history')->get();
    }

    /**
     * @param Index $index
     * @param string $period
     * @return static
     */
    public function getChartData(Index $index, $period = 'day')
    {

        switch ($period) {
            case 'day':
                $date = '-1 day';
                $format = 'H:m:s';
                break;
            case 'month':
                $date = '-1 month';
                $format = 'M d';
                break;
            case 'year':
                $date = '-1 year';
                $format = 'M';
                break;
        }

        //$date = Carbon::now()->subDays($days);
        $date = Carbon::parse($date);

        $data = $index->history()->where('created_at', '>=', $date)->orderBy('created_at', 'ASC')->get()
                ->groupBy(function ($date) use ($format) {
                    return Carbon::parse($date->created_at)->format($format);
                });

        $dataSet = [];
        $labels = [];

        foreach ($data as $key => $item) {

            $labels[] = $key;
            foreach ($item as $value) {
                $dataSet[] = $value->value;
            }

        }

        return compact('dataSet', 'labels');

    }

    /**
     * @param Index $index
     * @param $coins
     * @return bool
     */
    public function recalculate(Index $index, $coins)
    {
        if ($index->divisor == null) {
            $index->divisor = array_sum(array_map('floatval', array_column($coins, 'market_cap_usd'))) / 1000;
        }
        $index->current_value = round(array_sum(array_map('floatval', array_column($coins, 'market_cap_usd'))) / $index->divisor, 2);

        if($index->current_value) {
            return $index->save();
        }

        return false;
    }


    /**
     * Recalculate all indices from http://coinmarketcap.com
     *
     * @return bool
     */
    public function recalculateAll()
    {
        $indices = Index::all();

        $data = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=500'), true);

        foreach ($indices as $index) {
            $coins = $data;
            if ($index->market_cap_min) {
                $coins = array_filter($coins, function ($item) use ($index) {
                    return floatval($item['market_cap_usd']) >= $index->market_cap_min;
                });
            }
            if ($index->market_cap_max) {
                $coins = array_filter($coins, function ($item) use ($index) {
                    return floatval($item['market_cap_usd']) < $index->market_cap_max;
                });
            }

            $this->recalculate($index, $coins);
        }
        return true;
    }

}