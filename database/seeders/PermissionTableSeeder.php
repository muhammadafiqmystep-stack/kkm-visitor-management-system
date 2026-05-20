<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web']
        );

        $permissionsNames = [
            'index visitors',
            'create visitors',
            'edit visitors',
            'delete visitors',
        ];

        $permissions = collect($permissionsNames)->map(
            fn (string $name) => Permission::firstOrCreate(
                ['name' => 'admin', 'guard_name' => 'web']
            )
        );

        $role->syncPermissions($permissions);

        //create new user
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
