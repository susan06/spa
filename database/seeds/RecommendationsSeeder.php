<?php

use Illuminate\Database\Seeder;

class RecommendationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recommendations')->insert([
            'branch_office_id' => 1,
            'client_id' => 3,
            'friend' => 'susangmedina@gmail.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('recommendations')->insert([
            'branch_office_id' => 1,
            'client_id' => 3,
            'friend' => 'rodolfo@gmail.com',
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
