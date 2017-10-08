<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
  public static function boot() {
    parent::boot();

    self::updated(function($model) {
      $index_value = new IndexValue();
      $index_value->index_id = $model->id;
      $index_value->value = $model->current_value;
      $index_value->created_at = $model->updated_at;
      $index_value->save();
    });
  }

  public function getHistory() {
    return IndexValue::orderby('created_at', 'asc')
      ->where('index_id', '=', $this->id)
      ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-24 hours')))
      ->get();
  }


  public function recalculate($coins) {
    if ($this->divisor == null) {
      $this->divisor = array_sum(array_map('floatval', array_column($coins, 'market_cap_usd'))) / 1000;
    }
    $this->current_value = round(array_sum(array_map('floatval', array_column($coins, 'market_cap_usd'))) / $this->divisor, 2);
    $this->save();
  }


  public static function recalculateAll() {
    $coins = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=500'), true);
    foreach(static::all() as $index) {
      $index_coins = $coins;
      if ($index->market_cap_min !== null) {
        $index_coins = array_filter($index_coins, function($item) use($index) {
          return floatval($item['market_cap_usd']) >= $index->market_cap_min;
        });
      }
      if ($index->market_cap_max !== null) {
        $index_coins = array_filter($index_coins, function($item) use($index) {
          return floatval($item['market_cap_usd']) < $index->market_cap_max;
        });
      }
      $index->recalculate($index_coins);
    }
  }
}
