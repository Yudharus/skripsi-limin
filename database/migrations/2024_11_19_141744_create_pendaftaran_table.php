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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_dokter');
            $table->string('status_pendaftaran');
            $table->date('tanggal_kunjungan');
            $table->text('keluhan')->nullable();
            $table->string('jenis_kunjungan')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id_dokter')->on('dokter')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
