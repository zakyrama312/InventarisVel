<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Jurusan::create([
            'nama_prodi' => 'RPL',
            'slug' => 'rekayasa-perangkat-lunak'
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
            'id_jurusan' => 1
        ]);
    }
}
