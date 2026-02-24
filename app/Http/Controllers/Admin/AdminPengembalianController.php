<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminPengembalianController extends Controller
{
    /**
     * =========================
     * HALAMAN PENGEMBALIAN
     * =========================
     */
    public function index()
    {
        $this->updateDenda();

        $pinjaman = Pinjam::with(['user','buku'])
            ->where('status', 'dipinjam')
            ->orderBy('tgl_kembali', 'asc')
            ->get();

        return view('admin.pengembalian', compact('pinjaman'));
    }

    /**
     * =========================
     * KONFIRMASI PENGEMBALIAN
     * (KONDISI BAIK)
     * =========================
     */
    public function konfirmasi($id)
    {
        DB::transaction(function () use ($id) {

            $pinjam = Pinjam::with('buku')->findOrFail($id);

            if ($pinjam->status !== 'dipinjam') return;

            $pinjam->update([
                'kondisi' => 'baik',
                'denda' => 0,
                'metode_bayar' => null,
                'status' => 'selesai'
            ]);

            DB::table('pengembalian')->insert([
                'pinjam_id' => $pinjam->id,
                'tgl_dikembalikan' => now(),
                'kondisi_buku' => 'baik',
                'total_denda' => 0,
                'metode_bayar' => null
            ]);

            $pinjam->buku->increment('stok');
        });

        return back()->with('success','Pengembalian berhasil dikonfirmasi');
    }

    /**
     * =========================
     * UPDATE DENDA OTOMATIS
     * (TELAT)
     * =========================
     */
    private function updateDenda()
    {
        $pinjaman = Pinjam::where('status','dipinjam')->get();

        foreach($pinjaman as $pinjam){

            if(now()->gt($pinjam->tgl_kembali)){

                $hariTelat = now()->startOfDay()
                    ->diffInDays(Carbon::parse($pinjam->tgl_kembali)->startOfDay());

                $denda = $hariTelat * 3000;

                $pinjam->update([
                    'status' => 'denda',
                    'denda' => $denda
                ]);
            }
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
            ->where('status','denda')
            ->orderBy('tgl_kembali','asc')
            ->get();

        return view('admin.denda', compact('denda'));
    }


    /**
     * =========================
     * KONFIRMASI DENDA TELAT
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
            'Denda berhasil dibayar & buku dikembalikan'
        );
    }

    public function bayarDenda($id)
    {
        $pinjam = Pinjam::with(['user','buku'])->findOrFail($id);
        return view('admin.bayar_denda', compact('pinjam'));
    }

public function prosesBayarDenda(Request $request,$id)
{
    $request->validate([
        'metode_bayar' => 'required|in:cash,qris',
        'kondisi' => 'required|in:baik,rusak,hilang'
    ]);

        DB::transaction(function() use ($request,$id){

            $pinjam = Pinjam::with('buku')->findOrFail($id);

            if($pinjam->status !== 'denda'){
                return;
            }

            // hitung tambahan kerusakan
            $tambahan = 0;

            if($request->kondisi === 'rusak'){
                $tambahan = 80000;
            }elseif($request->kondisi === 'hilang'){
                $tambahan = 120000;
            }

            // total final
            $totalFinal = $pinjam->denda + $tambahan;

            // update pinjam
            $pinjam->update([
                'kondisi' => $request->kondisi,
                'denda' => $totalFinal,
                'metode_bayar' => $request->metode_bayar,
                'status' => 'selesai'
            ]);

            //  masuk tabel pengembalian
            DB::table('pengembalian')->insert([
                'pinjam_id' => $pinjam->id,
                'tgl_dikembalikan' => now(),
                'kondisi_buku' => $request->kondisi,
                'total_denda' => $totalFinal,
                'metode_bayar' => $request->metode_bayar
            ]);

            // stok balik
            $pinjam->buku->increment('stok');
        });

        return redirect()->route('admin.denda')
            ->with('success','Denda berhasil dibayar & buku dikembalikan');
    }


    /**
     * =========================
     * HALAMAN VERIFIKASI
     * (RUSAK / HILANG)
     * =========================
     */
    public function verifikasi($id)
    {
        $pinjam = Pinjam::with(['user','buku'])->findOrFail($id);
        return view('admin.verifikasi', compact('pinjam'));
    }

    /**
     * =========================
     * PROSES VERIFIKASI
     * =========================
     */
    public function prosesVerifikasi(Request $request, $id)
    {
        $request->validate([
            'kondisi' => 'required|in:baik,rusak,hilang',
            'metode_bayar' => 'required|in:cash,qris'
        ]);

        DB::transaction(function () use ($request, $id) {

        $pinjam = Pinjam::with('buku')->findOrFail($id);

        $denda = 0;
        if ($request->kondisi === 'rusak') {
            $denda = 150000;
        } elseif ($request->kondisi === 'hilang') {
            $denda = 300000;
        }

        // update pinjam
        $pinjam->update([
            'kondisi' => $request->kondisi,
            'denda' => $denda,
            'metode_bayar' => $request->metode_bayar,
            'status' => 'selesai'
        ]);

        DB::table('pengembalian')->insert([
            'pinjam_id' => $pinjam->id,
            'tgl_dikembalikan' => now(),
            'kondisi_buku' => $request->kondisi,
            'total_denda' => $denda,
            'metode_bayar' => $request->metode_bayar
        ]);

        // stok balik
        $pinjam->buku->increment('stok');
        });


        return redirect()
            ->route('admin.pengembalian')
            ->with('success', 'Verifikasi pengembalian berhasil');
    }

    

}
