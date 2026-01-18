@extends('member.layout2')

@section('content')

<style>
:root{
    --dark:#111827;
    --muted:#6b7280;
    --soft:#f8fafc;
    --border:#e5e7eb;
    --accent:#4f46e5;
}

/* ================= HEADER ================= */
.page-header{
    text-align:center;
    margin:60px 0 45px;
}
.page-header h2{
    font-weight:800;
    font-size:34px;
    color:var(--dark);
}
.page-header p{
    color:var(--muted);
    font-size:15px;
    margin-top:6px;
}

/* ================= CARD ================= */
.book-card{
    border:0;
    border-radius:22px;
    background:#fff;
    overflow:hidden;
    height:100%;
    transition:.35s ease;
    box-shadow:0 14px 34px rgba(0,0,0,.08);
    display:flex;
    flex-direction:column;
}
.book-card:hover{
    transform:translateY(-10px);
    box-shadow:0 28px 65px rgba(0,0,0,.16);
}

/* ================= COVER ================= */
.book-cover{
    position:relative;
    height:300px;
    background:linear-gradient(180deg,#f9fafb,#eef2f7);
    display:flex;
    align-items:center;
    justify-content:center;
}

.book-cover img{
    max-width:80%;
    max-height:85%;
    object-fit:contain;
    box-shadow:0 16px 36px rgba(0,0,0,.22);
    border-radius:8px;
    transition:.35s ease;
}
.book-card:hover img{
    transform:scale(1.05);
}

/* ================= BADGE ================= */
.badge-status{
    position:absolute;
    top:16px;
    left:16px;
    padding:6px 14px;
    font-size:11px;
    font-weight:700;
    border-radius:999px;
    background:rgba(255,255,255,.9);
    backdrop-filter:blur(6px);
    box-shadow:0 6px 16px rgba(0,0,0,.15);
}
.badge-available{ color:#15803d; }
.badge-unavailable{ color:#b91c1c; }

/* ================= INFO ================= */
.book-body{
    padding:18px 20px 22px;
    display:flex;
    flex-direction:column;
    flex-grow:1;
}
.book-title{
    font-weight:700;
    font-size:16px;
    color:var(--dark);
    line-height:1.4;
}
.book-author{
    font-size:13px;
    color:var(--muted);
    margin-top:4px;
}

/* ================= STOCK ================= */
.book-stock{
    margin-top:10px;
    font-size:12px;
    font-weight:600;
    padding:6px 12px;
    border-radius:999px;
    width:fit-content;
}
.stock-ok{
    background:#ecfdf5;
    color:#047857;
}
.stock-empty{
    background:#fee2e2;
    color:#b91c1c;
}

/* ================= BUTTON ================= */
.btn-detail{
    margin-top:16px;
    padding:12px;
    border-radius:14px;
    font-weight:600;
    font-size:13px;
    text-align:center;
    text-decoration:none;
    background:#111827;
    color:white;
    transition:.3s ease;
}
.btn-detail:hover{
    background:#020617;
    color:white;
}

/* ================= EMPTY ================= */
.empty{
    text-align:center;
    color:var(--muted);
    font-size:15px;
    margin-top:100px;
}
</style>

<div class="container">

    {{-- ================= HEADER ================= --}}
    <div class="page-header">
        <h2>Koleksi Buku</h2>
        <p>Pilih buku favoritmu dan mulai membaca</p>
    </div>

    {{-- ================= EMPTY ================= --}}
    @if($buku->count() == 0)
        <p class="empty">Belum ada buku tersedia</p>
    @endif

    {{-- ================= GRID ================= --}}
    <div class="row g-4">
        @foreach ($buku as $b)
        <div class="col-xl-3 col-lg-4 col-md-6">

            <div class="book-card">

                {{-- COVER --}}
                <div class="book-cover">

                    @if($b->stok > 0)
                        <span class="badge-status badge-available">Tersedia</span>
                    @else
                        <span class="badge-status badge-unavailable">Tidak Tersedia</span>
                    @endif

                    <img
                        src="{{ $b->gambar
                            ? asset('gambar_buku/'.$b->gambar)
                            : 'https://via.placeholder.com/400x600?text=No+Cover'
                        }}"
                        alt="{{ $b->judul }}"
                        loading="lazy"
                    >
                </div>

                {{-- INFO --}}
                <div class="book-body">
                    <div class="book-title">{{ $b->judul }}</div>
                    <div class="book-author">{{ $b->penulis }}</div>

                    {{-- STOK --}}
                    @if($b->stok > 0)
                        <div class="book-stock stock-ok">
                            Stok: {{ $b->stok }}
                        </div>
                    @else
                        <div class="book-stock stock-empty">
                            Stok Habis
                        </div>
                    @endif

                    <a href="{{ route('member.buku.detail', $b->id) }}" class="btn-detail">
                        Lihat Detail
                    </a>
                </div>

            </div>

        </div>
        @endforeach
    </div>

</div>

@endsection
