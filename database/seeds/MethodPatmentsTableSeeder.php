<?php

use Illuminate\Database\Seeder;

class MethodPatmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('method_payments')->insert([
            'name' => 'Visa',
            'icon' => 'visa.jpg' 
        ]);

        DB::table('method_payments')->insert([
            'name' => 'Mastercard',
            'icon' => 'mastercard.jpg' 
        ]);
    }
}
