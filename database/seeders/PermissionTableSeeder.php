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
            'delete visitors',
            //-- premission users name --//
            'index users',
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
    }
}