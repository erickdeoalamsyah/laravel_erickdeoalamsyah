<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//Mewakili data rumah sakit
class RumahSakit extends Model
{
    protected $fillable = [
        'nama_rumah_sakit',
        'alamat',
        'email',
        'telepon',
    ];
//Relasi: satu rumah sakit punya banyak pasien.
    public function pasiens(): HasMany
    {
        return $this->hasMany(Pasien::class);
    }
}
