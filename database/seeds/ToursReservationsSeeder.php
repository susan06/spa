<?php

use Illuminate\Database\Seeder;

class ToursReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tours_reservations')->insert([
            'tour_id' => 1,
            'client_id' => 3,
            'details_client' => 'me urge reservar, porque estoy estresada',
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
