<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id('id_pasien'); // Primary Key
            $table->string('nik')->unique();
            $table->string('no_ktp')->unique();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('kota');
            $table->string('kode_pos');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('rt_rw');
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
