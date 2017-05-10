<?php

use Illuminate\Database\Seeder;

class FavoritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->insert([
            'branch_office_id' => 1,
            'client_id' => 3
        ]);

    }
}
