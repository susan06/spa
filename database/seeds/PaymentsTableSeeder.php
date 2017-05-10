<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('payments')->insert([
            'branch_office_id' => 1,
            'method_payment_id' => 1
        ]);

        DB::table('payments')->insert([
            'branch_office_id' => 1,
            'method_payment_id' => 2
        ]);

        DB::table('payments')->insert([
            'branch_office_id' => 2,
            'method_payment_id' => 1
        ]);
    }
}
