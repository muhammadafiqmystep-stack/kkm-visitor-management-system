<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web'],
        );

        $permissionNames = [
            'index visitors',
            'create visitors',
            'edit visitors',
            'soft delete visitors',
            'restoreDelete visitors',
            //-- premission users name --//
            'index users',
            'create users',
            'edit users',
            'delete users',
            //-- permission blogs name --//
            'index blogs',
            'create blogs',
            'edit blogs',
            'delete blogs',
        ];

        $permissions = collect($permissionNames)->map(
            fn (string $name) => Permission::firstOrCreate(
                ['name' => $name, 'guard_name' => 'web']
            )
        );

        $role->syncPermissions($permissions);

        $user = User::firstOrCreate(
            ['email' => 'spatie@example.com'],
            [
                'name' => 'Spatie Admin',
                'password' => Hash::make('password'),
            ]
        );

        $user->assignRole($role);

        // create new user with role subadmin that has permission to index visitor only
        $subadmin = User::firstOrCreate(
            ['email' => 'subadmin@example.com'],
            [
                'name' => 'SubAdmin',
                'password' => Hash::make('password'),
            ]
        );

        $role = Role::firstOrCreate(
            ['name' => 'subadmin', 'guard_name' => 'web']
        );

        $subadmin->assignRole($role);
        $subadmin->givePermissionTo('index visitors');

        // create a new user with role 'softdelete' that has permission to index visitor and soft delete visitor only
        $pegawai = User::firstOrCreate(
            ['email' => 'soft@example.com'],
            [
                'name' => 'Pegawai Soft Delete',
                'password' => Hash::make('password'),
            ]
        );
        $role = Role::firstOrCreate(
            ['name' => 'softdelete', 'guard_name' => 'web']
        );
        $pegawai->assignRole($role);
        $pegawai->givePermissionTo('index visitors');
        $pegawai->givePermissionTo('soft delete visitors');

        // create a new user with role 'restoreDelete' that has permission to index visitor and restoreDelete visitor only
        $pegawai = User::firstOrCreate(
            ['email' => 'restore@example.com'],
            [
                'name' => 'Pegawai Restore and Force Delete',
                'password' => Hash::make('password'),
            ]
        );
        $role = Role::firstOrCreate(
            ['name' => 'restoreDelete', 'guard_name' => 'web']
        );
        $pegawai->assignRole($role);
        $pegawai->givePermissionTo('index visitors');
        $pegawai->givePermissionTo('restoreDelete visitors');
    }
}