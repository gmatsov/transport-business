<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(EmissionClassSeeder::class);
        $this->call(ReportingPeriodSeeder::class);
        $this->call(CostsCategoriesSeeder::class);
        $this->call(CostsSubCategoriesSeeder::class);
    }
}
