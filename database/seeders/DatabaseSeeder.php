<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $employeeRole = Role::create(['name' => 'employee']);

        // Create permissions if needed
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view reports']);

        // Assign permissions to roles if needed
        $adminRole->givePermissionTo('manage users');
        $employeeRole->givePermissionTo('view reports');

        // Create admin user
        $admin = User::create([
            'username' => '1',
            'name' => 'Test Admin',
            'email' => 'testadmin@gmail.com',
            'password' => bcrypt('12345678'),
            'kode_dept' => 'ITD',
            'kode_cabang' => '1',
            'no_tlpn' => '08123456789',
            'alamat' => 'Jimbaran',
            'kode_jabatan' => '1',
        ]);
        $admin->assignRole($adminRole);

        // Create employee user
        $employee = User::create([
            'username' => '2',
            'name' => 'Test Employee',
            'email' => 'testemployee@gmail.com',
            'password' => bcrypt('12345678'),
            'kode_dept' => 'HR',
            'kode_cabang' => '1',
            'no_tlpn' => '0812345678',
            'alamat' => 'Jimbaran',
            'kode_jabatan' => '2',
        ]);
        $employee->assignRole($employeeRole);
    }
}
