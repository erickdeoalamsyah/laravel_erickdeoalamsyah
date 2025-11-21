<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//Menyimpan data pasien beserta relasi ke rumah sakit.
class Pasien extends Model
{
    protected $fillable = [
        'nama_pasien',
        'alamat',
        'no_telpon',
        'rumah_sakit_id',
    ];
//Relasi: pasien milik satu rumah sakit.
    public function rumahSakit(): BelongsTo
    {
        return $this->belongsTo(RumahSakit::class);
    }
}
