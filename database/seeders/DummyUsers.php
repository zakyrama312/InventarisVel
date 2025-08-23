<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'role' => 'admin',
                'password' => bcrypt('admin123'),
                'id_jurusan' => 1
            ],
            [
                'name' => 'Petugas',
                'username' => 'petugas',
                'role' => 'petugas',
                'password' => bcrypt('petugas123'),
                'id_jurusan' => 1
            ]
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        }
    }
}
