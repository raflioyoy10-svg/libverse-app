<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberPublicController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\PinjamController;
use App\Http\Controllers\Admin\AdminPengembalianController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Buku;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', [MemberPublicController::class, 'index'])->name('public.member');
Route::get('/tentang-kami', [MemberPublicController::class, 'tentang'])->name('public.tentang');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'Berhasil logout');
})->name('logout');

/*
|--------------------------------------------------------------------------
| MEMBER (LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/member', [MemberController::class, 'index'])->name('member.dashboard');

    Route::get('/member/notifikasi', [MemberController::class, 'notifikasi'])->name('member.notifikasi');

    Route::get('/member/buku/{id}', [MemberController::class, 'detailBuku'])
        ->name('member.buku.detail');

    Route::post('/member/pinjam/{buku}', [MemberController::class, 'pinjam'])
        ->name('member.pinjam');

    Route::get('/member/pinjaman', [MemberController::class, 'pinjaman'])
        ->name('member.pinjaman');

    Route::get('/member/kategori', [MemberController::class, 'kategori'])
        ->name('member.kategori');

    Route::get('/member/kategori/{id}', [MemberController::class, 'bukuByKategori'])
        ->name('member.kategori.buku');

    Route::get('/member/ulasan', [MemberController::class, 'ulasan'])
        ->name('member.ulasan');

    Route::post('/member/ulasan', [MemberController::class, 'simpanUlasan'])
        ->name('member.ulasan.store');

    Route::get('/member/riwayat', [MemberController::class, 'riwayat'])
        ->name('member.riwayat');
});

/*
|--------------------------------------------------------------------------
| ADMIN (LOGIN + ADMIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class])
    ->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    /*
    |----------------
    | BUKU
    |----------------
    */
    Route::get('/buku', [BukuController::class, 'index'])
        ->name('admin.buku.index');

    Route::get('/buku/tambah', [BukuController::class, 'create'])
        ->name('buku.create');

    Route::post('/buku/tambah', [BukuController::class, 'store'])
        ->name('buku.store');

    Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])
        ->name('admin.buku.edit');

    Route::post('/buku/update/{id}', [BukuController::class, 'update'])
        ->name('admin.buku.update');

    Route::get('/buku/{id}/detail', [BukuController::class, 'detail'])
        ->name('admin.buku.detail');

    Route::post('/admin/kategori/quick-store', [\App\Http\Controllers\Admin\KategoriController::class, 'quickStore'])
        ->name('admin.kategori.quickStore');

    Route::get('/buku/{id}/download', function ($id) {
        $buku = Buku::findOrFail($id);
        return response()->download(
            storage_path('app/public/pdf/' . $buku->file_pdf)
        );
    })->name('admin.buku.download');

    Route::delete('/buku/{id}/hapus', [BukuController::class, 'destroy'])
        ->name('admin.buku.delete');

    /*
    |----------------
    | PEMINJAMAN
    |----------------
    */
    Route::get('/peminjaman', [PinjamController::class, 'index'])
        ->name('admin.peminjaman.index');

    Route::get('/peminjaman-aktif', [PinjamController::class, 'aktif'])
        ->name('admin.peminjaman.aktif');

    Route::post('/peminjaman/{pinjam}/setujui', [PinjamController::class, 'setujui'])
        ->name('admin.peminjaman.setujui');

    Route::post('/peminjaman/{pinjam}/tolak', [PinjamController::class, 'tolak'])
        ->name('admin.peminjaman.tolak');

    Route::post('/peminjaman/{pinjam}/kembalikan', [PinjamController::class, 'kembalikan'])
        ->name('admin.peminjaman.kembalikan');
    
    Route::get('/peminjaman-daftar',[PinjamController::class, 'daftar'])
        ->name('admin.peminjaman.daftar');

    Route::get('/peminjaman/{pinjam}/detail',[PinjamController::class, 'detail']
        )->name('admin.peminjaman.detail');

    Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/peminjaman/{id}/detail', [PinjamController::class, 'detail'])
        ->name('admin.peminjaman.detail');});

    Route::post('/admin/peminjaman/{id}/selesaikan',[AdminPengembalianController::class, 'pindahKePengembalian'])
        ->name('admin.peminjaman.selesaikan');

    Route::post('/admin/peminjaman/{id}/selesai', [PinjamController::class, 'selesai'])->name('admin.peminjaman.selesai');

    Route::post('/admin/peminjaman/{id}/selesaikan', [PinjamController::class, 'pindahKePengembalian'])
        ->name('admin.peminjaman.selesaikan');

    Route::post('/admin/peminjaman/{id}/selesaikan', [AdminPengembalianController::class, 'pindahKePengembalian'])
        ->name('admin.peminjaman.selesaikan');
    /*
    |----------------
    | PENGEMBALIAN & DENDA
    |----------------
    */
    Route::get('/admin/pengembalian', [AdminPengembalianController::class, 'index'])
        ->name('admin.pengembalian.index');

    Route::get('/pengembalian', [AdminPengembalianController::class, 'index'])
        ->name('admin.pengembalian');

    Route::post('/pengembalian/{id}/konfirmasi',
        [AdminPengembalianController::class, 'konfirmasi']
    )->name('admin.pengembalian.konfirmasi');

    Route::get('/denda', [AdminPengembalianController::class, 'denda'])
        ->name('admin.denda');

    Route::post('/denda/{id}/konfirmasi',
        [AdminPengembalianController::class, 'konfirmasiDenda']
    )->name('admin.denda.konfirmasi');

    /*
    |----------------
    | LAPORAN & ULASAN
    |----------------
    */
    Route::get('/laporan/populer', [LaporanController::class, 'bukuPopuler'])
        ->name('admin.laporan.populer');

    Route::get('/laporan/peminjaman', [LaporanController::class, 'peminjaman'])
        ->name('admin.laporan.peminjaman');

    Route::get('/ulasan', [UlasanController::class, 'index'])
        ->name('admin.ulasan.index');
});
