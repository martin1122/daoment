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
use Illuminate\Support\Facades\DB;

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
        return $this->model->orderby('position', 'asc')->get();
    }

    /**
     * @param Index $index
     * @param string $period
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChartData(Index $index, $period = 'day')
    {

        switch ($period) {
            case 'month':
                $date = '-1 month';
                $format = '%Y-%m-%d %H';
                break;
            case '3 months':
                $date = '-3 month';
                $format = '%Y-%m-%d %H';
                break;
            case 'year':
                $date = '-1 year';
                $format = '%Y-%m-%d %H';
                break;
            case '5 years':
                $date = '-5 years';
                $format = '%Y-%m-%d %H';
                break;
            case 'max':
                $date = '-20 years';
                $format = '%Y-%m-%d %H';
                break;
            case 'day':
            default:
                $date = '-3 day';
                $format = '%Y-%m-%d %H:%i:%s';
                break;
        }

        $date = Carbon::parse($date);

        $data = $index->history()->where('created_at', '>=', $date)
            ->select('*')
            ->orderBy('created_at', 'ASC')
            ->selectRaw('date_format(created_at, \'' . $format . '\' ) date')
            ->groupBy('date')
            ->get();

        return $data;
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