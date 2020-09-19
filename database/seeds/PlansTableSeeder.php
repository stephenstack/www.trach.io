<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'name' => 'basic',
            'description' => 'The \'small\' plan allows you to create 1 account with 5 carers',
            'price' => '5',
            'user_count' => '5'
        ]);

        DB::table('plans')->insert([
            'name' => 'plus',
            'description' => 'The \'family\' plan allows you to create 1 account with 12 carers',
            'price' => '10',
            'user_count' => '12'
        ]);

        DB::table('plans')->insert([
            'name' => 'pro',
            'description' => 'The \'team\' plan allows you to create 1 account with 20 carers',
            'price' => '20',
            'user_count' => '20'
        ]);
    }
}
