<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pinjam_id');
            $table->date('tgl_dikembalikan');

            $table->foreign('pinjam_id')->references('id')->on('pinjam');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
