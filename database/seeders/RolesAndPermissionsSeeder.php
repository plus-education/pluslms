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

        // Create student permissions
        Permission::create(['name' => 'list only my courses']);
        Permission::create(['name' => 'show only my course']);
        Permission::create(['name' => 'show only my user']);
        Permission::create(['name' => 'update only my user']);

        $student = Role::create(['name' => 'student']);
        $student->givePermissionTo(Permission::all());

        // Create teacher permissions
        Permission::create(['name' => 'update only my course']);
        Permission::create(['name' => 'list only my users']);

        $teacher = Role::create(['name' => 'teacher']);
        $teacher->givePermissionTo(Permission::all());

        // Create admin permissions
        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'list courses']);
        Permission::create(['name' => 'show course']);
        Permission::create(['name' => 'create course']);
        Permission::create(['name' => 'edit course']);
        Permission::create(['name' => 'delete course']);

        Permission::create(['name' => 'list access codes']);
        Permission::create(['name' => 'show access code']);
        Permission::create(['name' => 'create access code']);
        Permission::create(['name' => 'edit access code']);
        Permission::create(['name' => 'delete access code']);

        Permission::create(['name' => 'manage settings']);
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'manage translations']);
        Permission::create(['name' => 'manage backup']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());
    }
}
