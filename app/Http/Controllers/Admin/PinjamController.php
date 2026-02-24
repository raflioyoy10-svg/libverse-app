<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
    // =========================
    // 📌 DAFTAR PENGAJUAN
    // =========================
    public function index()
    {
        $pinjaman = Pinjam::with(['buku', 'user'])
            ->where('status', 'menunggu')
            ->orderBy('tgl_pinjam', 'asc')
            ->get();

        return view('admin.peminjaman.index', compact('pinjaman'));
    }

    // =========================
    // ✅ SETUJUI PINJAMAN (PAKAI JAMINAN)
    // =========================
    public function setujui(Request $request, Pinjam $pinjam)
    {
        if ($pinjam->status !== 'menunggu') {
            return back();
        }

        // 🔒 validasi jaminan (INI INTI REVISI UKK)
        $request->validate([
            'jaminan' => 'required|in:ktp,sim,kartu_pelajar'
        ]);

        DB::transaction(function () use ($pinjam, $request) {

            // ❌ stok habis
            if ($pinjam->buku->stok < 1) {
                abort(400, 'Stok buku habis');
            }

            // 🔽 kurangi stok
            $pinjam->buku->decrement('stok');

            // ubah status + simpan jaminan
            $pinjam->update([
                'status'  => 'dipinjam',
                'jaminan' => $request->jaminan
            ]);

            // 🔔 notifikasi
            Notifikasi::create([
                'user_id' => $pinjam->user_id,
                'pesan'   => '✅ Peminjaman buku "' . $pinjam->buku->judul . '" disetujui admin dengan jaminan'
            ]);
        });

        return back()->with('success', 'Peminjaman disetujui');
    }

    // =========================
    // ❌ TOLAK PINJAMAN
    // =========================
    public function tolak(Pinjam $pinjam)
    {
        if ($pinjam->status !== 'menunggu') {
            return back();
        }

        $pinjam->update([
            'status' => 'ditolak'
        ]);

        Notifikasi::create([
            'user_id' => $pinjam->user_id,
            'pesan'   => '❌ Peminjaman buku "' . $pinjam->buku->judul . '" ditolak admin'
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    // =========================
    // 📚 PINJAMAN AKTIF
    // =========================
    public function aktif()
    {
        $pinjaman = Pinjam::with(['buku', 'user'])
            ->where('status', 'dipinjam')
            ->orderBy('tgl_kembali', 'asc')
            ->get();

        return view('admin.peminjaman.aktif', compact('pinjaman'));
    }

    // =========================
    // 🔁 KEMBALIKAN BUKU
    // =========================
    public function kembalikan(Pinjam $pinjam)
    {
        if ($pinjam->status !== 'dipinjam') {
            return back();
        }

        DB::transaction(function () use ($pinjam) {

            // 🔼 stok kembali
            $pinjam->buku->increment('stok');

            $pinjam->update([
                'status' => 'selesai',
                'tgl_kembali' => Carbon::now()
            ]);

            Notifikasi::create([
                'user_id' => $pinjam->user_id,
                'pesan'   => '📦 Buku "' . $pinjam->buku->judul . '" telah dikembalikan'
            ]);
        });

        return back()->with('success', 'Buku berhasil dikembalikan');
    }

   public function daftar()
{
    $pinjaman = Pinjam::with(['buku', 'user'])
        ->where('status', 'dipinjam')
        ->orderBy('tgl_kembali', 'asc')
        ->get();

    return view('admin.peminjaman.daftar', compact('pinjaman'));
}


    public function detail($id)
    {
        $pinjam = Pinjam::with(['user','buku.kategori'])
            ->findOrFail($id);

        return view('admin.peminjaman.detail', compact('pinjam'));
    }

    public function selesai($id)
    {
        $pinjam = Pinjam::findOrFail($id);

        if(in_array($pinjam->status, ['selesai', 'denda'])) {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        return redirect()->route('admin.pengembalian')
            ->with('success', 'Peminjaman sudah selesai, silahkan proses pengembalian di halaman Pengembalian.');
    }

    // Jaminan
    public function updateJaminan(Request $request,$id)
{
    $request->validate([
        'jaminan' => 'required|in:ktp,sim,kartu_pelajar'
    ]);

    $pinjam = Pinjam::findOrFail($id);

    $pinjam->update([
        'jaminan' => $request->jaminan
    ]);

    return back()->with('success','Jaminan berhasil diubah');
}

}
