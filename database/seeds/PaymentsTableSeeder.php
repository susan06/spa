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

        DB::table('payments')->insert([
            'branch_office_id' => 3,
            'method_payment_id' => 1
        ]);      

        DB::table('payments')->insert([
            'branch_office_id' => 4,
            'method_payment_id' => 1
        ]);  

        DB::table('payments')->insert([
            'branch_office_id' => 5,
            'method_payment_id' => 1
        ]);   

        DB::table('payments')->insert([
            'branch_office_id' => 6,
            'method_payment_id' => 1
        ]);    

        DB::table('payments')->insert([
            'branch_office_id' => 7,
            'method_payment_id' => 1
        ]);   

        DB::table('payments')->insert([
            'branch_office_id' => 8,
            'method_payment_id' => 1
        ]);

        DB::table('payments')->insert([
            'branch_office_id' => 9,
            'method_payment_id' => 1
        ]);

        DB::table('payments')->insert([
            'branch_office_id' => 10,
            'method_payment_id' => 1
        ]);
    }
}
