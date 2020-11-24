<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /*
         * create permissions
         */
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'manage translations']);
        Permission::create(['name' => 'manage backup']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'list courses']);
        Permission::create(['name' => 'list only my courses']);
        Permission::create(['name' => 'create courses']);
        Permission::create(['name' => 'edit courses']);
        Permission::create(['name' => 'delete courses']);

        Permission::create(['name' => 'list groups']);
        Permission::create(['name' => 'list only my groups']);
        Permission::create(['name' => 'show group']);
        Permission::create(['name' => 'create group']);
        Permission::create(['name' => 'edit group']);
        Permission::create(['name' => 'delete group']);

        // create roles and assign created permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $teacher = Role::create(['name' => 'supervisor']);
        $teacher = Role::create(['name' => 'teacher']);
        $student = Role::create(['name' => 'student']);
    }
}
