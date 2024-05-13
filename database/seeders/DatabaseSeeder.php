<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => '1',
            'name' => 'Test Admin',
            'email' => 'testadmin@gmail.com',
            'password' => bcrypt('12345678'),
            'kode_dept' => 'ITD',
            'kode_cabang' => '1',
            'no_tlpn' => '0895343866012',
            'alamat' => 'Jl.Kubung Batu 1 A No.3, Taman Griya Jimbaran',
            'kode_jabatan' => '1',

        ]);
    }
}
