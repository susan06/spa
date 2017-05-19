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
            'service' => 4,
            'environment' => 4,
            'attention' => 1,
            'price' => 5
        ]);

        DB::table('scores')->insert([
            'branch_office_id' => 3,
            'client_id' => 3,
            'service' => 3,
            'environment' => 1,
            'attention' => 2,
            'price' => 5
        ]); 

       DB::table('scores')->insert([
            'branch_office_id' => 4,
            'client_id' => 3,
            'service' => 3,
            'environment' => 4,
            'attention' => 3,
            'price' => 4
        ]); 

       DB::table('scores')->insert([
            'branch_office_id' => 5,
            'client_id' => 3,
            'service' => 4,
            'environment' => 4,
            'attention' => 4,
            'price' => 4
        ]); 

    }
}
