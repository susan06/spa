<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Empresa test 1',
            'owner_id' => 2
        ]);

        DB::table('companies')->insert([
            'name' => 'Empresa test 2',
            'owner_id' => 2
        ]);
    }
}
