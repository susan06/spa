<?php

use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            'user_from' => 2,
            'user_to' => 1,
            'subject' => 'hola, saludos',
            'description' => 'hola, te saluda un propietario',
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('messages')->insert([
            'user_from' => 3,
            'user_to' => 1,
            'subject' => 'hola, como estas, saludos',
            'description' => 'hola, te saluda un cliente',
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
