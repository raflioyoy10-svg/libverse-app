<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use Illuminate\Support\Facades\DB;

class AdminPengembalianController extends Controller
{
    /**
     * =========================
     * HALAMAN PENGEMBALIAN
     * =========================
     * tampilkan:
     * - status dipinjam
     * - waktu SUDAH habis
     * - BELUM denda
     */
    public function index()
    {
        $this->updateDenda(); // 🔥 aman, tidak ubah logika

        $pinjaman = Pinjam::with(['user','buku'])
            ->where('status', 'dipinjam') // tampilkan semua yang sedang dipinjam
            ->orderBy('tgl_kembali', 'asc')
            ->get();

        return view('admin.pengembalian', compact('pinjaman'));
    }

    /**
     * =========================
     * KONFIRMASI PENGEMBALIAN
     * =========================
     */
    public function konfirmasi($id)
    {
        DB::transaction(function () use ($id) {

            $pinjam = Pinjam::with('buku')->findOrFail($id);

            // ❌ cegah dobel proses
            if ($pinjam->status !== 'dipinjam') {
                return;
            }

            // ✅ ubah status
            $pinjam->update([
                'status' => 'selesai'
            ]);

            // ✅ stok kembali
            $pinjam->buku->increment('stok');
        });

        return back()->with(
            'success',
            'Pengembalian berhasil dikonfirmasi & stok buku bertambah'
        );
    }

    /**
     * =========================
     * UPDATE DENDA OTOMATIS
     * =========================
     * logika:
     * - lewat deadline
     * - +1 hari
     * - belum dikembalikan
     */
    private function updateDenda()
    {
        $pinjamTelat = Pinjam::where('status', 'dipinjam')
            ->where('tgl_kembali', '<', now()->subDay()) // 🔥 H+1
            ->get();

        foreach ($pinjamTelat as $p) {
            $p->update([
                'status' => 'denda'
            ]);
        }
    }

    /**
     * =========================
     * HALAMAN DENDA
     * =========================
     */
    public function denda()
    {
        $this->updateDenda();

        $denda = Pinjam::with(['user','buku'])
            ->where('status', 'denda')
            ->orderBy('tgl_kembali', 'asc')
            ->get();

        return view('admin.denda', compact('denda'));
    }

    /**
     * =========================
     * KONFIRMASI DENDA
     * =========================
     */
    public function konfirmasiDenda($id)
    {
        DB::transaction(function () use ($id) {

            $pinjam = Pinjam::with('buku')->findOrFail($id);

            if ($pinjam->status !== 'denda') {
                return;
            }

            $pinjam->update([
                'status' => 'selesai'
            ]);

            $pinjam->buku->increment('stok');
        });

        return back()->with(
            'success',
            'Denda dibayar & buku berhasil dikembalikan'
        );
    }

    public function pindahKePengembalian($id)
{
    $pinjam = Pinjam::findOrFail($id);

    // ❌ hanya bisa diproses jika status masih dipinjam
    if ($pinjam->status !== 'dipinjam') {
        return back()->with('error', 'Peminjaman ini sudah diproses.');
    }

    // ⚡ Jangan ubah status, biar muncul di halaman pengembalian
    // Status tetap "dipinjam" sampai admin konfirmasi
    return redirect()->route('admin.pengembalian')
        ->with('success', 'Peminjaman dipindahkan ke halaman pengembalian. Silahkan konfirmasi admin.');
}


}
