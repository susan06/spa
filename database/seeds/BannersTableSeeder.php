<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('banners')->insert([
            'priority' => 1,
            'name' => '020520170839.jpg'
        ]);

        DB::table('banners')->insert([
            'priority' => 2,
            'name' => '020520170840.jpg'
        ]);

        DB::table('banners')->insert([
            'priority' => 3,
            'name' => '020520170841.jpg'
        ]);

        DB::table('banners')->insert([
            'priority' => 4,
            'name' => '020520170842.jpg'
        ]);

        DB::table('banners')->insert([
            'priority' => 5,
            'name' => '020520170843.jpg'
        ]);

        DB::table('banners')->insert([
            'priority' => 6,
            'name' => '020520170844.jpg'
        ]);
    
    }
}
