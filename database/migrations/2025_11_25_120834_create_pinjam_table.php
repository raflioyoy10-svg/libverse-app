<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjam', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('buku_id');

    // tanggal
    $table->date('tgl_pinjam')->nullable();   // diisi saat admin setujui
    $table->date('tgl_kembali')->nullable();

    // status semi-online
    $table->enum('status', [
        'menunggu',
        'dipinjam',
        'selesai',
        'ditolak'
    ])->default('menunggu');

    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->foreign('buku_id')->references('id')->on('buku')->cascadeOnDelete();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('pinjam');
    }
};
