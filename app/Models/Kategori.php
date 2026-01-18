<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori'; 
    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = ['nama_kategori'];

    // Relasi: 1 kategori punya banyak buku
    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id')
                    ->where('is_active', 1);
    }
}
