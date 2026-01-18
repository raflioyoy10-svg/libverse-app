<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // Grafik buku terpopuler
    public function bukuPopuler()
    {
        $populer = Pinjam::select('buku_id', DB::raw('COUNT(*) as total'))
            ->whereHas('buku', function($q) {
                $q->where('is_active', 1); // hanya buku aktif
            })
            ->groupBy('buku_id')
            ->orderBy('total', 'DESC')
            ->with(['buku' => function($q) {
                $q->where('is_active', 1); // eager load buku aktif
            }])
            ->take(10)
            ->get();

        return view('admin.laporan.populer', compact('populer'));
    }

    // Laporan peminjaman
    public function peminjaman()
    {
        $pinjam = Pinjam::with(['buku' => function($q) {
                $q->where('is_active', 1); // hanya buku aktif
            }, 'user'])
            ->whereHas('buku', function($q) {
                $q->where('is_active', 1); // filter pinjam berdasarkan buku aktif
            })
            ->orderBy('tgl_pinjam', 'DESC')
            ->get();

        return view('admin.laporan.peminjaman', compact('pinjam'));
    }
}
