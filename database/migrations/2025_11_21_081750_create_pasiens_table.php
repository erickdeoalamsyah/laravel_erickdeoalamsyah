<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Menyimpan data pasien dan foreign key ke rumah_sakits.
return new class extends Migration
{
    /**
     *
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pasien');
        $table->string('alamat')->nullable();
        $table->string('no_telpon', 20)->nullable();
        // relasi ke rumah_sakits
        $table->foreignId('rumah_sakit_id')
              ->constrained('rumah_sakits')
              ->cascadeOnDelete();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
