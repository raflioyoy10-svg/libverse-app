<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminPinjamController extends Controller
{
    public function index()
    {
        $pinjaman = Pinjam::with(['buku', 'user'])
            ->where('status', 'menunggu')
            ->orderBy('tgl_pinjam', 'asc')
            ->get();

        return view('admin.peminjaman.index', compact('pinjaman'));
    }

    public function setujui($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        $pinjam->update([
                'status' => 'dipinjam'
                ]);
                
        Notifikasi::create([
            'user_id' => $pinjam->user_id,
            'pesan'   => '✅ Peminjaman buku "'.$pinjam->buku->judul.'" disetujui admin'
        ]);

        return back()->with('success', 'Peminjaman disetujui');
    }

    public function tolak($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        $pinjam->update([
            'status' => 'ditolak'
        ]);

        Notifikasi::create([
            'user_id' => $pinjam->user_id,
            'pesan'   => '❌ Peminjaman buku "'.$pinjam->buku->judul.'" ditolak admin'
        ]);

        return back()->with('error', 'Peminjaman ditolak');
    }
}
