<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage checklists']);

        // create roles and assign created permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('manage users');

        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $user = Role::create(['name' => 'user']);

        $blocked = Role::create(['name' => 'blocked']);

        // create demo users
        $user1 = User::create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('secret123'),
            'max_checklist' => 10,
        ]);
        $user1->assignRole($superAdmin);

        $user2 = User::create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
            'max_checklist' => 10,
        ]);
        $user2->assignRole($admin);

        $user3 = User::create([
            'name' => 'Example Admin User 2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('secret123'),
            'max_checklist' => 10,
        ]);
        $user3->assignRole($admin);
    }
}
