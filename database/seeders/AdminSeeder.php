<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::unguard();
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Account',
            'email' => 'admin.account@gmail.com',
            'username' => 'admin-account',
            'password' => Hash::make('123456'),
            'is_active' => true,
            'is_admin' => true
        ]);
        $roleID = Role::where('name', 'Admin')->first()->id;
        $admin->roles()->attach($roleID);
    }
}
