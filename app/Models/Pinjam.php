<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Buku;

class Pinjam extends Model
{
    protected $table = 'pinjam';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'buku_id',
        'tgl_pinjam',
        'tgl_kembali',
        'status'
    ];

    protected $casts = [
        'tgl_pinjam'  => 'datetime',
        'tgl_kembali' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
    // app/Models/Pinjam.php

public function getHariTelatAttribute()
{
    if ($this->status !== 'denda') {
        return 0;
    }

    $deadline = Carbon::parse($this->tgl_kembali);
    $hariIni  = now();

    if ($hariIni <= $deadline) {
        return 0;
    }

    return $deadline->diffInDays($hariIni);
}

public function getTotalDendaAttribute()
{
    return $this->hari_telat * 3000;
}

}

