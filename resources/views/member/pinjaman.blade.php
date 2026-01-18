@extends('member.layout2')

@section('content')

<style>
:root{
    --dark:#0f172a;
    --muted:#64748b;
    --border:#e5e7eb;
    --soft:#f8fafc;
}

/* ================= TITLE ================= */
.page-title{
    font-size:26px;
    font-weight:800;
    margin-bottom:36px;
    text-align:center;
    color:var(--dark);
}

/* ================= GRID ================= */
.pinjam-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
    gap:24px;
}

/* ================= CARD ================= */
.pinjam-card{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    border:1px solid var(--border);
    display:flex;
    flex-direction:column;
    transition:.25s;
}
.pinjam-card:hover{
    transform:translateY(-4px);
    box-shadow:0 18px 42px rgba(15,23,42,.12);
}

/* ================= COVER ================= */
.book-cover{
    width:100%;
    height:260px;
    background:#f8fafc;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:18px;
}

.book-cover img{
    max-width:100%;
    max-height:100%;
    object-fit:contain; /* 🔑 BIAR TIDAK KE-CROP */
    border-radius:8px;
}

/* ================= BODY ================= */
.pinjam-body{
    padding:16px 18px 18px;
    display:flex;
    flex-direction:column;
    gap:4px;
    flex-grow:1;
}

.pinjam-body h5{
    font-size:15px;
    font-weight:700;
    color:var(--dark);
}

.pinjam-body p{
    font-size:13px;
    color:var(--muted);
}

/* ================= DATE ================= */
.duration{
    margin-top:8px;
    font-size:12px;
    color:#374151;
    background:var(--soft);
    padding:6px 10px;
    border-radius:10px;
    width:fit-content;
}

/* ================= BADGE ================= */
.badge{
    margin-top:12px;
    padding:6px 14px;
    font-size:11px;
    border-radius:999px;
    font-weight:700;
    width:fit-content;
}

.menunggu{
    background:#fff7ed;
    color:#9a3412;
}
.dipinjam{
    background:#eef2ff;
    color:#3730a3;
}
.selesai{
    background:#ecfdf5;
    color:#065f46;
}

/* ================= EMPTY ================= */
.empty-state{
    text-align:center;
    color:var(--muted);
    margin-top:90px;
    font-size:14px;
}

/* ================= MOBILE ================= */
@media(max-width:576px){
    .page-title{
        font-size:22px;
    }
}
</style>

<h2 class="page-title">Status Peminjaman Buku</h2>

@if($pinjaman->isEmpty())
    <div class="empty-state">
        Belum ada pengajuan peminjaman
    </div>
@else

<div class="pinjam-grid">
@foreach($pinjaman as $p)

    <div class="pinjam-card">

        <div class="book-cover">
            <img 
                src="{{ $p->buku->gambar 
                    ? asset('gambar_buku/'.$p->buku->gambar) 
                    : 'https://via.placeholder.com/400x600?text=Buku' }}"
                alt="Cover buku {{ $p->buku->judul }}"
            >
        </div>

        <div class="pinjam-body">
            <h5>{{ $p->buku->judul }}</h5>
            <p>{{ $p->buku->penulis }}</p>

            <span class="duration">
                {{ $p->tgl_pinjam->format('d M Y') }} – {{ $p->tgl_kembali->format('d M Y') }}
            </span>

            @if($p->status == 'dipinjam')
                <span class="badge dipinjam">SEDANG DIPINJAM</span>
            @elseif($p->status == 'selesai')
                <span class="badge selesai">SELESAI</span>
            @else
                <span class="badge menunggu">MENUNGGU KONFIRMASI</span>
                <p style="margin-top:6px;font-size:12px;color:#6b7280">
                    Silakan datang ke perpustakaan
                </p>
            @endif
        </div>

    </div>

@endforeach
</div>

@endif

@endsection
