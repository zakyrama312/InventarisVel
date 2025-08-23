<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyJurusan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusanData = [
            [
                'nama_jurusan' => 'Pengembangan Perangkat Lunak dan GIM',
                'slug' => 'pengembangan-perangkat-lunak-dan-gim'
            ],
            [
                'nama_jurusan' => 'Broadcasting Perfilman',
                'slug' => 'broadcasting-perfilman'
            ],
            ];

        foreach ($jurusanData as $key => $value) {
            Jurusan::create($value);
        }
    }
}
