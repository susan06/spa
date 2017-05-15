<?php

use Illuminate\Database\Seeder;

class BranchOfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('branch_offices')->insert([
            'company_id' => 1,
            'province_id' => 1, 
            'name' => 'local 1',
            'address' => 'av ejemplo, calle ejemplo',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.537981,
            'lng' => -80.782127,
            'phone_one' => 123456789,
            'phone_second' => 987654321,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo@ejemplo.com',
            'reservation_web' => true,
            'reservation_discount' => true,
            'percent_discount' => 10,
            'created_at' => \Carbon\Carbon::now()
        ]);

    	  DB::table('branch_offices')->insert([
            'company_id' => 1,
            'province_id' => 2, 
            'name' => 'local 2',
            'address' => 'av ejemplo 2, calle ejemplo 2',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.637981,
            'lng' => -80.882127,
            'phone_one' => 554444778,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo2@ejemplo.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('branch_offices')->insert([
            'company_id' => 1,
            'province_id' => 3, 
            'name' => 'local 3',
            'address' => 'av ejemplo 3, calle ejemplo 3',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.637981,
            'lng' => -80.882127,
            'phone_one' => 554444778,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo2@ejemplo.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('branch_offices')->insert([
            'company_id' => 1,
            'province_id' => 4, 
            'name' => 'local 4',
            'address' => 'av ejemplo 4, calle ejemplo 4',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.637981,
            'lng' => -80.882127,
            'phone_one' => 554444778,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo2@ejemplo.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('branch_offices')->insert([
            'company_id' => 1,
            'province_id' => 5, 
            'name' => 'local 5',
            'address' => 'av ejemplo 5, calle ejemplo 5',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.637981,
            'lng' => -80.882127,
            'phone_one' => 554444778,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo2@ejemplo.com',
            'created_at' => \Carbon\Carbon::now()
        ]);


        DB::table('branch_offices')->insert([
            'company_id' => 2,
            'province_id' => 1, 
            'name' => 'local 6',
            'address' => 'av ejemplo 6, calle ejemplo 6',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.537981,
            'lng' => -80.782127,
            'phone_one' => 123456789,
            'phone_second' => 987654321,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo@ejemplo.com',
            'reservation_web' => true,
            'reservation_discount' => true,
            'percent_discount' => 10,
            'created_at' => \Carbon\Carbon::now()
        ]);

          DB::table('branch_offices')->insert([
            'company_id' => 2,
            'province_id' => 2, 
            'name' => 'local 7',
            'address' => 'av ejemplo 7, calle ejemplo 7',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.637981,
            'lng' => -80.882127,
            'phone_one' => 554444778,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo2@ejemplo.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('branch_offices')->insert([
            'company_id' => 2,
            'province_id' => 3, 
            'name' => 'local 8',
            'address' => 'av ejemplo 8, calle ejemplo 8',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.637981,
            'lng' => -80.882127,
            'phone_one' => 554444778,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo2@ejemplo.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('branch_offices')->insert([
            'company_id' => 2,
            'province_id' => 4, 
            'name' => 'local 9',
            'address' => 'av ejemplo 9, calle ejemplo 9',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.637981,
            'lng' => -80.882127,
            'phone_one' => 554444778,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo2@ejemplo.com',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('branch_offices')->insert([
            'company_id' => 2,
            'province_id' => 5, 
            'name' => 'local 10',
            'address' => 'av ejemplo 10, calle ejemplo 10',
            'address_description' => 'esto seria la descripcion de la direción, como referencias',
            'lat' => 8.637981,
            'lng' => -80.882127,
            'phone_one' => 554444778,
            'working_hours' => 'Abierto de lunes a domingo desde las 8:00 am hasta las 3:00 pm',
            'email' => 'ejemplo2@ejemplo.com',
            'created_at' => \Carbon\Carbon::now()
        ]);


                                      
    }
}
