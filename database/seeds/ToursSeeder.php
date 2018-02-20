<?php

use Illuminate\Database\Seeder;

class ToursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tours')->insert([
            'branch_office_id' => 1,
            'title' => '3 días de descanso',
            'date_start' => '2017-02-24',
            'date_end' => '2018-02-26',
            'view_start' => '2017-02-13',
            'view_end' => '2018-02-24',
            'description' => 'Paquete turistico, no te lo puedes perder.',
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
