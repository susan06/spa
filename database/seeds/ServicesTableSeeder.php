<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'branch_office_id' => 1,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 10,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 1,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 15,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 2,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 2,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 3,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 3,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 4,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 4,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 5,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 5,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 6,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 6,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 7,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 7,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 8,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 8,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 9,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 9,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 10,
            'name' => 'servicio 1', 
            'details' => 'detalles del servicio',
            'price' => 20,
        ]);

        DB::table('services')->insert([
            'branch_office_id' => 10,
            'name' => 'servicio 2', 
            'details' => 'detalles del servicio',
            'price' => 25,
        ]);


    }
}
