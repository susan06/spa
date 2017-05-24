<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'System Administrator',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'owner',
            'display_name' => 'Propietario',
            'description' => 'Perfil Propietario',
            'removable' => false
        ]);

        DB::table('roles')->insert([
            'name' => 'client',
            'display_name' => 'Cliente',
            'description' => 'Perfil Cliente',
            'removable' => false
        ]);
    
    }
}
