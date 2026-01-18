<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'penulis',
        'kategori_id',
        'stok',
        'gambar',
        'link_pdf' // yang baru
    ];

    // RELASI: Buku milik 1 kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'buku_id');
    }

    public function pinjamanAktif()
    {
        return $this->hasMany(Pinjam::class)
        ->where('status', 'dipinjam');
    }

    public function pinjam()
{
    return $this->hasMany(Pinjam::class, 'buku_id');
}



}
