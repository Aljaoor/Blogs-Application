<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => Carbon::now(),
        ]);


        $admin->assignRole(Role::where('name','Admin')->first());

        $admin = User::create([
            'name' => 'Author',
            'email' => 'author@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => Carbon::now(),
        ]);

        $admin->assignRole(Role::where('name','Author')->where('guard_name', 'web')->first());
        $admin->assignRole(Role::where('name','Author')->where('guard_name', 'api')->first());

        \App\Models\User::factory(5)
            ->hasAttached(Role::where('name','Author')->first())
            ->create();

    }
}
