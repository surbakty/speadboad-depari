<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->unique();
            $table->string('nama_pemesan');
            $table->date('tgl_kunjungan');
            $table->integer('jumlah_orang');
            $table->enum('kategori', ['wisata', 'prewed']);
            $table->decimal('total_harga', 12, 2);
            $table->enum('status_bayar', ['pending', 'lunas'])->default('pending');
            $table->enum('status_hadir', ['belum', 'selesai'])->default('belum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};