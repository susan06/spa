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
            'name' => 'clients.manage',
            'display_name' => 'Gestión de clientes',
            'description' => '',
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

        $permissions[] = Permission::create([
            'name' => 'company.manage',
            'display_name' => 'Gestión de compañias',
            'description' => '',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'banner.manage',
            'display_name' => 'Gestión de banners',
            'description' => '',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'faq.manage',
            'display_name' => 'Gestión de FAQs',
            'description' => '',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'term.manage',
            'display_name' => 'Gestión de términos y condiciones',
            'description' => '',
            'removable' => false
        ]);

        $permissions_branch[] = Permission::create([
            'name' => 'branch.manage',
            'display_name' => 'Gestión de locales',
            'description' => '',
            'removable' => false
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->attachPermissions($permissions);
        $adminRole->attachPermissions($permissions_branch);

        $permissions_owner[] = Permission::create([
            'name' => 'reservation.manage',
            'display_name' => 'Gestión de reservas',
            'description' => '',
            'removable' => false
        ]);

        $permissions_owner[] = Permission::create([
            'name' => 'tour.manage',
            'display_name' => 'Gestión de tours',
            'description' => '',
            'removable' => false
        ]);

        $ownerRole = Role::where('name', 'owner')->first();
        $ownerRole->attachPermissions($permissions_owner);
        $ownerRole->attachPermissions($permissions_branch);

    }
    
}
