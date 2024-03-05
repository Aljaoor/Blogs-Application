<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions(Permission::where('guard_name', 'web')->get());

        $author = Role::create([
            'name' => 'Author',
            'guard_name' => 'web',
        ]);

        $authorPermissions = Permission::where('guard_name', 'web')
            ->whereIn('name', ['Posts Management'])->get();
        $author->syncPermissions($authorPermissions);

        $authorApi = Role::create([
            'name' => 'Author',
            'guard_name' => 'api',
        ]);
        $authorPermissions = Permission::where('guard_name', 'api')
            ->whereIn('name', ['Posts Management'])->get();
        $authorApi->syncPermissions($authorPermissions);

        $user = Role::create([
            'name' => 'Web User',
            'guard_name' => 'web',
        ]);

        $userApi = Role::create([
            'name' => 'Mobile User',
            'guard_name' => 'api',
        ]);
    }
}
