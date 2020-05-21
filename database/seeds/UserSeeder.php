<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => true
        ]);
    }
}
