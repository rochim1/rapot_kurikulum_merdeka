<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin =User::create([
            'name'=>'Administrator',
            'email'=>'firmansyah@unisayogya.ac.id',
            'password'=>bcrypt('password')
        ]);
        $roleAdmin =Role::create(['name'=>'admin']);
        $roleWalas =Role::create(['name'=>'walas']);

        $admin->assignRole($roleAdmin);

    }
}
