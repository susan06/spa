<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('photos')->insert([
            'branch_office_id' => 1,
            'name' => '050520171044.jpg'
        ]);

        DB::table('photos')->insert([
            'branch_office_id' => 1,
            'name' => '050520171045.jpg'
        ]);

        DB::table('photos')->insert([
            'branch_office_id' => 1,
            'name' => '050520171046.jpg'
        ]);

        DB::table('photos')->insert([
            'branch_office_id' => 1,
            'name' => '050520171047.jpg'
        ]);

        DB::table('photos')->insert([
            'branch_office_id' => 2,
            'name' => '050520171010.jpg'
        ]);

        DB::table('photos')->insert([
            'branch_office_id' => 2,
            'name' => '050520171011.jpg'
        ]);

        DB::table('photos')->insert([
            'branch_office_id' => 2,
            'name' => '050520171012.jpg'
        ]);

        DB::table('photos')->insert([
            'branch_office_id' => 2,
            'name' => '050520171013.jpg'
        ]);

    }
}
