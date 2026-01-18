@extends('admin.layout')

@section('title', 'Detail Peminjaman')

@section('content')

<style>
.page-title{
    font-size:22px;
    font-weight:700;
    margin-bottom:20px;
}

.card-modern{
    border:none;
    border-radius:18px;
    box-shadow:0 12px 32px rgba(0,0,0,.08);
}

.book-cover{
    width:100%;
    height:360px;
    object-fit:cover;
    border-radius:14px;
    box-shadow:0 10px 28px rgba(0,0,0,.12);
}

.info-row{
    padding:10px 0;
    border-bottom:1px dashed #e5e7eb;
}

.info-row:last-child{
    border-bottom:none;
}

.label{
    color:#6b7280;
    font-size:14px;
}

.value{
    font-weight:600;
    font-size:15px;
}

.badge-status{
    padding:8px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}
</style>

<div class="container py-4">

    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm mb-4">
        ← Kembali
    </a>

    <div class="page-title">📘 Detail Peminjaman</div>

    <div class="row g-4">

        {{-- 📚 BUKU --}}
        <div class="col-md-4">
            <div class="card card-modern p-3 h-100 text-center">

                <img
                    src="{{ $pinjam->buku->gambar 
                        ? asset('gambar_buku/'.$pinjam->buku->gambar) 
                        : 'https://via.placeholder.com/400x600?text=No+Cover' }}"
                    class="book-cover mb-3"
                    alt="{{ $pinjam->buku->judul }}"
                >

                <h5 class="fw-bold mb-1">{{ $pinjam->buku->judul }}</h5>
                <div class="text-muted mb-2">
                    {{ $pinjam->buku->penulis ?? '-' }}
                </div>

                <span class="badge bg-light text-dark">
                    {{ $pinjam->buku->kategori->nama_kategori ?? '-' }}
                </span>
            </div>
        </div>

        {{-- 👤 PEMINJAMAN --}}
        <div class="col-md-8">
            <div class="card card-modern p-4">

                <h5 class="fw-bold mb-4">Informasi Peminjaman</h5>

                <div class="info-row d-flex">
                    <div class="col-5 label">Nama Peminjam</div>
                    <div class="col-7 value">
                        {{ $pinjam->user->nama }}
                    </div>
                </div>

                <div class="info-row d-flex">
                    <div class="col-5 label">Tanggal Pinjam</div>
                    <div class="col-7 value">
                        {{ \Carbon\Carbon::parse($pinjam->tgl_pinjam)->format('d M Y') }}
                    </div>
                </div>

                <div class="info-row d-flex">
                    <div class="col-5 label">Batas Pengembalian</div>
                    <div class="col-7 value text-danger">
                        {{ \Carbon\Carbon::parse($pinjam->tgl_kembali)->format('d M Y') }}
                    </div>
                </div>

                <div class="info-row d-flex align-items-center">
                    <div class="col-5 label">Status</div>
                    <div class="col-7">
                        @php
                            $badge = match($pinjam->status) {
                                'menunggu' => 'secondary',
                                'dipinjam' => 'primary',
                                'denda'    => 'danger',
                                'selesai'  => 'success',
                                default    => 'dark'
                            };
                        @endphp
                        <span class="badge badge-status bg-{{ $badge }}">
                            {{ strtoupper($pinjam->status) }}
                        </span>
                    </div>
                </div>

                {{-- INFO TAMBAHAN --}}
                <div class="mt-4">
                    @if($pinjam->status === 'dipinjam')
                        <div class="alert alert-warning rounded-3 mb-0">
                            ⏳ Buku masih dipinjam dan belum dikembalikan.
                        </div>
                    @elseif($pinjam->status === 'denda')
                        <div class="alert alert-danger rounded-3 mb-0">
                            ⚠️ Peminjaman melewati batas waktu dan dikenakan denda.
                        </div>
                    @elseif($pinjam->status === 'selesai')
                        <div class="alert alert-success rounded-3 mb-0">
                            ✅ Peminjaman telah selesai.
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
