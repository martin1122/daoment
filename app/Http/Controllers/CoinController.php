<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{

    /**
     * @var array
     */
    protected $coins = ['bitcoin', 'ethereum'];

    /**
     * @var array
     */
    protected $converts = ['USD', 'EUR', 'AUD'];

    /**
     * @return mixed
     */
    public function get()
    {
       return Coin::whereIn('coin', $this->coins)->whereIn('convert', $this->converts)->get();
    }
}
