<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostsSubCategoriesSeeder extends Seeder
{
    const INITIAL_PURCHASE_ID = 1;
    const MAINTENANCE_AND_CARE_ID = 2;
    const INSURANCE_TOLL_TAXES_ID = 3;
    const WORKERS_ID = 4;
    const OTHERS = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('costs_sub_categories')->insert(['name' => 'Първоначална покупка на МПС', 'main_category_id' => self::INITIAL_PURCHASE_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Регистрационни такси', 'main_category_id' => self::INITIAL_PURCHASE_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Други', 'main_category_id' => self::INITIAL_PURCHASE_ID]);

        DB::table('costs_sub_categories')->insert(['name' => 'Автомивка', 'main_category_id' => self::MAINTENANCE_AND_CARE_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Обслужване', 'main_category_id' => self::MAINTENANCE_AND_CARE_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Ремонт', 'main_category_id' => self::MAINTENANCE_AND_CARE_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Други', 'main_category_id' => self::MAINTENANCE_AND_CARE_ID]);

        DB::table('costs_sub_categories')->insert(['name' => 'Автокаско', 'main_category_id' => self::INSURANCE_TOLL_TAXES_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Гражданска отговорност', 'main_category_id' => self::INSURANCE_TOLL_TAXES_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Застраховка ЧМР', 'main_category_id' => self::INSURANCE_TOLL_TAXES_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Данък', 'main_category_id' => self::INSURANCE_TOLL_TAXES_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Технически преглед', 'main_category_id' => self::INSURANCE_TOLL_TAXES_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Винетки/Пътни такси', 'main_category_id' => self::INSURANCE_TOLL_TAXES_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Лизинг', 'main_category_id' => self::INSURANCE_TOLL_TAXES_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Други', 'main_category_id' => self::INSURANCE_TOLL_TAXES_ID]);

        DB::table('costs_sub_categories')->insert(['name' => 'Заплата', 'main_category_id' => self::WORKERS_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Глоба', 'main_category_id' => self::WORKERS_ID]);
        DB::table('costs_sub_categories')->insert(['name' => 'Други', 'main_category_id' => self::WORKERS_ID]);

        DB::table('costs_sub_categories')->insert(['name' => 'Паркинг', 'main_category_id' => self::OTHERS]);
        DB::table('costs_sub_categories')->insert(['name' => 'Неустойки и приспаднати суми', 'main_category_id' => self::OTHERS]);
    }
}
