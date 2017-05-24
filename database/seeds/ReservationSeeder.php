<?php

use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            'branch_office_id' => 1,
            'client_id' => 3,
            'date' => '2017-05-25',
        	'hour' => '02:00 PM',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('reservations')->insert([
            'branch_office_id' => 1,
            'client_id' => 3,
            'date' => '2017-05-26',
        	'hour' => '03:00 PM',
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
