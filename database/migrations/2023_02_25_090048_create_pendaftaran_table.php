<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('id');
            $table->string('uuid', 100);
            $table->foreignId('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            // $table->string('no_surat', 20);
            $table->string('dokumen', 100);
            $table->date('tanggal_pendaftaran');
            $table->string('masa_magang', 35);
            $table->string('surat_penerimaan')->nullable();
            $table->enum('is_approved', ['Menunggu Konfirmasi', 'Disetujui', 'Ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};
