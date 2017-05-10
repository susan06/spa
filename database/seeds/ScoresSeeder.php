<?php

use Illuminate\Database\Seeder;

class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scores')->insert([
            'branch_office_id' => 1,
            'client_id' => 3,
            'service' => 5,
            'environment' => 4,
            'attention' => 3,
            'price' => 5
        ]);

        DB::table('scores')->insert([
            'branch_office_id' => 2,
            'client_id' => 3,
            'service' => 5,
            'environment' => 5,
            'attention' => 4,
            'price' => 3
        ]);
    }
}
