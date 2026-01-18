<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\Pinjam;

class AdminController extends Controller
{
    public function index()
{
    $totalBuku = Buku::count();
    $totalUser = User::count();
    $peminjamanAktif = Pinjam::where('status','dipinjam')->count();

    $recentPeminjaman = Pinjam::join('users', 'pinjam.user_id', '=', 'users.id')
    ->join('buku', 'pinjam.buku_id', '=', 'buku.id')
    ->whereIn('pinjam.status', ['menunggu', 'dipinjam'])
    ->orderBy('pinjam.tgl_pinjam', 'desc')
    ->limit(6)
    ->select(
        'pinjam.status',
        'pinjam.tgl_pinjam',
        'users.nama as user_nama',
        'buku.judul as judul_buku'
    )
        ->get();

    return view('admin.dashboard', compact(
        'totalBuku',
        'totalUser',
        'peminjamanAktif',
        'recentPeminjaman'
    ));
    }
}
