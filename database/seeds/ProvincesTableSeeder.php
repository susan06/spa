<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            'name' => 'Provincia de Bocas del Toro',
        ]);

        DB::table('provinces')->insert([
            'name' => 'Provincia de Coclé',
        ]);

         DB::table('provinces')->insert([
            'name' => 'Provincia de Colón',
        ]);

        DB::table('provinces')->insert([
            'name' => 'Provincia de Chiriquí',
        ]);

        DB::table('provinces')->insert([
            'name' => 'Provincia de Darién',
        ]);

        DB::table('provinces')->insert([
            'name' => 'Provincia de Herrera',
        ]);

        DB::table('provinces')->insert([
            'name' => 'Provincia de Los Santos',
        ]);
        
        DB::table('provinces')->insert([
            'name' => 'Provincia de Panamá',
        ]);

        DB::table('provinces')->insert([
            'name' => 'Provincia de Veraguas',
        ]);

        DB::table('provinces')->insert([
            'name' => 'Provincia de Panamá Oeste',
        ]);
    }
}
