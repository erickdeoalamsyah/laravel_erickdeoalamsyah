<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Seeder;

class RumahSakitSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_rumah_sakit' => 'RS Mayapada',
                'alamat'           => 'Jl. Buah Batu No. 1',
                'email'            => 'info@mayapada.com',
                'telepon'          => '021123456',
            ],
            [
                'nama_rumah_sakit' => 'RS Oetomo',
                'alamat'           => 'Jl. Bojongsoang No. 2',
                'email'            => 'info@oetomo.com',
                'telepon'          => '021654321',
            ],
        ];

        foreach ($data as $item) {
            RumahSakit::create($item);
        }
    }
}
