<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->unsignedBigInteger('kategori_id');
            $table->integer('stok')->default(1);

            // Relasi
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
