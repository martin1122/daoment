<?php

use App\Models\Index;
use Illuminate\Database\Seeder;

class IndicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indices = array(
            array(
                'name' => 'Composite',
                'description' => '<p>The <strong>Composite Index</strong> comprises the top 500 coins of the cryptocurrency world</p>',
                'position' => 1
            ),
            array(
                'name' => 'Megacap',
                'description' => '<p>The <strong>Megacap Index</strong> is calculated from the cryptocurrency coins whose market capitalization is greater than or equal to 2 billion USD.</p>',
                'position' => 2,
                'market_cap_min' => 20000000000
            ),
            array(
                'name' => 'Largecap',
                'description' => '<p>The <strong>Largecap Index</strong> is calculated from the cryptocurrency coins whose market capitalization is greater than or equal to 100 million USD, but under 2 billion USD.</p>',
                'position' => 3,
                'market_cap_min' => 1000000000,
                'market_cap_max' => 20000000000,
            ),
            array(
                'name' => 'Midcap',
                'description' => '<p>The <strong>Midcap Index</strong> is calculated from the cryptocurrency coins whose market capitalization is greater than or equal to 10 million USD, but under 100 million USD.</p>',
                'position' => 4,
                'market_cap_min' => 100000000,
                'market_cap_max' => 1000000000,
            ),
            array(
                'name' => 'Smallcap',
                'description' => '<p>The <strong>Smallcap Index</strong> is calculated from the cryptocurrency coins whose market capitalization is greater than or equal to 1 million USD, but under 10 million USD.</p>',
                'position' => 5,
                'market_cap_min' => 1000000,
                'market_cap_max' => 1000000000,
            ),
            array(
                'name' => 'Microcap',
                'description' => '<p>The <strong>Microcap Index</strong> is calculated from the cryptocurrency coins whose market capitalization falls under 1 million USD.</p>',
                'position' => 6,
                'market_cap_max' => 1000000,
            )
        );

        foreach ($indices as $data) {
            Index::create($data);
        }
    }
}
