<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('costs_categories')->insert(['name' => 'Първоначална покупка']);
        DB::table('costs_categories')->insert(['name' => 'Подържка и грижи']);
        DB::table('costs_categories')->insert(['name' => 'Застраховки, Данъци & Други такси']);
        DB::table('costs_categories')->insert(['name' => 'Работници']);
        DB::table('costs_categories')->insert(['name' => 'Други']);

    }
}
