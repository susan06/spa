<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // permisos administrador
        
        $permissions[] = Permission::create([
            'name' => 'users.manage',
            'display_name' => 'Gestión de usuarios',
            'description' => 'Administrar usuarios y sus sesiones.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'users.activity',
            'display_name' => 'Registro de actividades',
            'description' => 'Ver la actividad de todos los usuarios.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'roles.manage',
            'display_name' => 'Gestión de Roles',
            'description' => 'Administrar los roles.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'permissions.manage',
            'display_name' => 'Gestión de permisos',
            'description' => 'Administrar los permisos de los roles.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'settings.general',
            'display_name' => 'Configuración general del sistema',
            'description' => '',
            'removable' => false
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->attachPermissions($permissions);
    }
    
}
