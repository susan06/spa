<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\Support\User\UserStatus;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_1 = User::create([
            'name' => 'admin',
            'lastname' => 'superAdmin',
            'email' => 'admin@site.com',
            'username' => 'admin',
            'password' => 'secret',
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);

        $superadmin = Role::where('name', 'admin')->first();
        $user_1->attachRole($superadmin);

        $user_2 = User::create([
            'name' => 'owner',
            'lastname' => 'owner',
            'email' => 'owner@site.com',
            'username' => 'owner',
            'password' => 'secret',
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);

        $owner = Role::where('name', 'owner')->first();
        $user_2->attachRole($owner);

        $user_3 = User::create([
            'name' => 'client',
            'lastname' => 'client',
            'email' => 'client@site.com',
            'username' => 'client',
            'password' => 'secret',
            'status' => UserStatus::ACTIVE,
            'created_at' => \Carbon\Carbon::now()
        ]);

        $client = Role::where('name', 'client')->first();
        $user_3->attachRole($client);
    }
}
