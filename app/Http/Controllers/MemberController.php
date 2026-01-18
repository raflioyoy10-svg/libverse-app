<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pinjam;
use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index()
    {
        $this->updateStatusPinjaman();

        $buku = Buku::where('is_active', 1)->get();

        // tampilkan stok asli (AMAN)
        foreach ($buku as $b) {
            $b->tersedia = (int) $b->stok;
        }

        return view('member.dashboard', compact('buku'));
    }

    // =============================
    // 🔥 PINJAM BUKU
    // =============================
    public function pinjam(Request $request, Buku $buku)
{
    // ================= CEK STATUS BUKU =================
    if ($buku->is_active == 0) {
        return back()->with('error', 'Buku ini sudah tidak tersedia.');
    }

    if ($buku->stok < 1) {
        return back()->with('error', 'Maaf, stok buku ini sedang habis.');
    }

    // ================= TAMBAHAN: CEK PINJAM BUKU YANG SAMA =================
    $sudahPinjam = Pinjam::where('user_id', auth()->id())
        ->where('buku_id', $buku->id)
        ->whereIn('status', ['menunggu', 'dipinjam']) // masih aktif
        ->exists();

    if ($sudahPinjam) {
        return back()->with(
            'error',
            'Kamu masih memiliki peminjaman aktif untuk buku ini. Kembalikan dulu sebelum meminjam lagi.'
        );
    }

    // ================= VALIDASI =================
    $request->validate([
        'masa_pinjam' => 'required|integer|min:1|max:7',
    ]);

    $masaPinjam = (int) $request->masa_pinjam;

    // ================= SIMPAN PINJAMAN =================
    Pinjam::create([
        'user_id'     => auth()->id(),
        'buku_id'     => $buku->id,
        'tgl_pinjam'  => now(),
        // 🔥 FIX: 24 JAM REAL
        'tgl_kembali' => now()->addHours(24 * $masaPinjam),
        'status'      => 'menunggu',
    ]);

    return redirect()->route('member.pinjaman')
        ->with('success', 'Peminjaman berhasil diajukan. Menunggu persetujuan admin.');
}


    public function kategori(Request $request)
    {
        $kategori = Kategori::when($request->q, function ($q) use ($request) {
            $q->where('nama_kategori', 'like', '%' . $request->q . '%');
        })->get();

        return view('member.kategori', compact('kategori'));
    }

    public function bukuByKategori($id)
    {
        $kategori = Kategori::findOrFail($id);

        $buku = Buku::where('kategori_id', $id)
            ->where('is_active', 1)
            ->get();

        foreach ($buku as $b) {
            $b->tersedia = (int) $b->stok;
        }

        return view('member.buku-kategori', compact('kategori', 'buku'));
    }

    public function pinjaman()
    {
        $pinjaman = Pinjam::with('buku')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->orderBy('tgl_pinjam', 'desc')
            ->get();

        return view('member.pinjaman', compact('pinjaman'));
    }

    public function detailBuku($id)
{
    $this->updateStatusPinjaman();

    $buku = Buku::where('id', $id)
        ->where('is_active', 1)
        ->firstOrFail();

    $buku->tersedia = (int) $buku->stok;

    // ================= TAMBAHAN (TIDAK MENGUBAH LOGIKA) =================
    $sedangDipinjam = false;

    if (auth()->check()) {
        $sedangDipinjam = \App\Models\Pinjam::where('user_id', auth()->id())
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->exists();
    }
    // ===================================================================

    return view('member.detail-buku', compact('buku', 'sedangDipinjam'));
}

    /**
     * 🔥 UPDATE STATUS PINJAMAN
     * ❗ TIDAK MENYELESAIKAN OTOMATIS
     * ❗ ADMIN YANG KONFIRMASI
     */
    private function updateStatusPinjaman()
    {
        $pinjamTelat = Pinjam::where('status', 'dipinjam')
            ->where('tgl_kembali', '<', now())
            ->get();

        foreach ($pinjamTelat as $p) {

            $sudahNotif = Notifikasi::where('user_id', $p->user_id)
                ->where('pesan', 'like', '%Masa pinjam buku%')
                ->exists();

            if (!$sudahNotif) {
                Notifikasi::create([
                    'user_id' => $p->user_id,
                    'pesan'   => '⏰ Masa pinjam buku "' . $p->buku->judul . '" telah HABIS. Segera kembalikan ke admin.'
                ]);
            }
        }
    }

    public function riwayat()
{
    $riwayat = Pinjam::with('buku')
        ->where('user_id', auth()->id())
        ->where('status', 'selesai')
        ->whereHas('buku', function ($query) {
            $query->where('is_active', 1); // ✅ hanya buku aktif
        })
        ->orderBy('tgl_kembali', 'desc')
        ->get();

    return view('member.riwayat', compact('riwayat'));
}


    public function simpanUlasan(Request $request)
    {
        $request->validate([
            'buku_id'  => 'required',
            'komentar' => 'required|min:5'
        ]);

        Ulasan::updateOrCreate(
            [
                'buku_id' => $request->buku_id,
                'user_id' => auth()->id()
            ],
            [
                'komentar' => $request->komentar
            ]
        );

        return back()->with('success', 'Ulasan berhasil dikirim');
    }

    public function ulasan(Request $request)
{
    // Hanya ambil buku yang aktif
    $query = Buku::with(['kategori', 'ulasan.user'])
        ->where('is_active', 1); // ✅ filter buku aktif

    // Filter pencarian judul
    if ($request->search) {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    // Filter kategori
    if ($request->kategori) {
        $query->where('kategori_id', $request->kategori);
    }

    $buku = $query->orderBy('judul')->get();
    $kategori = Kategori::all();

    return view('member.ulasan', compact('buku', 'kategori'));
}


    public function notifikasi()
    {
        $notifikasi = Notifikasi::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.notifikasi', compact('notifikasi'));
    }
}
