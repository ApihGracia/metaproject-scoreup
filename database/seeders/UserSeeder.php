<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'admin']);
        Permission::create(['name' => 'technician']);

        Role::create(['name' => 'admin'])->givePermissionTo('admin');
        Role::create(['name' => 'technician'])->givePermissionTo('technician');

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@local.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'technician',
            'email' => 'technician@local.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('technician');
 
    }
}
