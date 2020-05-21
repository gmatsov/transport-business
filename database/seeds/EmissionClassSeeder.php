<?php

use Illuminate\Database\Seeder;

class EmissionClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emission_classes')->insert(
            [
                'emission_category' => 'IV',
            ]);
        DB::table('emission_classes')->insert(
            [
                'emission_category' => 'V',
            ]);
        DB::table('emission_classes')->insert(
            [
                'emission_category' => 'VI',
            ]);
    }

}
