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
          Schema::create('videotron', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('waktumulai');
            $table->string('waktuselesai');
            $table->string('nama_peminjam');
            $table->string('contact_peminjam');
            $table->string('nama_petugas');
            $table->string('contact_petugas');
            $table->string('nama_acara');
            $table->string('status');
            $table->string('link_video');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videotron');
    }
};
