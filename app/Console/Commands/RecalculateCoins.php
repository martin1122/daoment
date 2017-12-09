<?php

namespace App\Console\Commands;

use App\Models\Coin;
use Illuminate\Console\Command;

class RecalculateCoins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coins:recalculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate coins';

    /**
     * @var array
     */
    protected $coins = ['bitcoin', 'ethereum'];

    /**
     * @var array
     */
    protected $converts = ['USD', 'EUR', 'AUD'];

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
        foreach ($this->coins as $coin) {
            foreach ($this->converts as $convert) {
                $data = json_decode(file_get_contents("https://api.coinmarketcap.com/v1/ticker/{$coin}/?convert={$convert}"), true);
                foreach ($data as $item) {
                    Coin::updateOrCreate([
                        'coin' => $coin,
                        'convert' => $convert,
                    ], [
                        'data' => $item
                    ]);
                }
            }
        }
    }
}
