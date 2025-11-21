<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        Pasien::create([
            'nama_pasien'   => 'Alim',
            'alamat'        => 'Lodaya',
            'no_telpon'     => '0811111111',
            'rumah_sakit_id'=> 1,
        ]);

        Pasien::create([
            'nama_pasien'   => 'Imam',
            'alamat'        => 'Turangga',
            'no_telpon'     => '0822222222',
            'rumah_sakit_id'=> 2,
        ]);
    }
}
