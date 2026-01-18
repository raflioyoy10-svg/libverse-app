@extends('member.layout2')

@section('content')

<style>
:root{
    --dark:#0f172a;
    --muted:#64748b;
    --soft:#f8fafc;
    --border:#e5e7eb;
    --accent:#1e40af;
}

/* ================= HEADER ================= */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:26px;
}

.page-title{
    font-size:26px;
    font-weight:800;
    color:var(--dark);
}

.page-sub{
    font-size:14px;
    color:var(--muted);
}

/* ================= SEARCH ================= */
.search-box{
    position:relative;
    max-width:260px;
}

.search-box input{
    width:100%;
    padding:10px 16px 10px 40px;
    border-radius:999px;
    border:1px solid var(--border);
    font-size:14px;
}

.search-box i{
    position:absolute;
    top:50%;
    left:14px;
    transform:translateY(-50%);
    color:var(--muted);
}

/* ================= GRID ================= */
.book-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(210px,1fr));
    gap:30px;
}

/* ================= CARD ================= */
.book-card{
    background:#fff;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 12px 30px rgba(0,0,0,.06);
    transition:.35s ease;
    display:flex;
    flex-direction:column;
    opacity:0;
    transform:translateY(30px);
}

.book-card.show{
    opacity:1;
    transform:translateY(0);
}

.book-card:hover{
    transform:translateY(-10px);
    box-shadow:0 25px 55px rgba(0,0,0,.12);
}

/* ================= COVER ================= */
.cover-wrapper{
    height:260px;
    background:linear-gradient(180deg,#f8fafc,#eef2f7);
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
}

.cover-wrapper img{
    max-height:85%;
    max-width:85%;
    object-fit:contain;
    box-shadow:0 14px 30px rgba(0,0,0,.18);
    border-radius:8px;
}

/* ================= BADGE ================= */
.badge-stock{
    position:absolute;
    top:14px;
    left:14px;
    font-size:11px;
    padding:6px 14px;
    border-radius:999px;
    font-weight:600;
    background:rgba(255,255,255,.9);
}

.badge-available{ color:#15803d; }
.badge-empty{ color:#b91c1c; }

/* ================= INFO ================= */
.book-info{
    padding:16px 18px;
    flex-grow:1;
}

.book-title{
    font-size:15px;
    font-weight:700;
    color:var(--dark);
    line-height:1.4;
    margin-bottom:4px;
}

.book-author{
    font-size:13px;
    color:var(--muted);
}

/* ================= FOOTER ================= */
.book-footer{
    padding:0 18px 18px;
}

.btn-detail{
    width:100%;
    padding:10px;
    border-radius:14px;
    font-size:14px;
    font-weight:600;
    background:var(--dark);
    color:white;
    border:none;
    transition:.25s;
}

.btn-detail:hover{
    background:#020617;
}

.btn-disabled{
    background:#e5e7eb;
    color:#9ca3af;
    cursor:not-allowed;
}

/* ================= EMPTY ================= */
.empty-box{
    padding:40px;
    text-align:center;
    border-radius:20px;
    background:#f8fafc;
    color:#64748b;
}
</style>

{{-- ================= HEADER ================= --}}
<div class="page-header">
    <div>
        <div class="page-title">
            Kategori • {{ $kategori->nama_kategori }}
        </div>
        <div class="page-sub">
            Koleksi buku pilihan di kategori ini
        </div>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="search-box">
            <input type="text" id="searchBook" placeholder="Cari buku...">
        </div>

        <a href="{{ route('member.kategori') }}" class="btn btn-light rounded-pill px-4">
            ← Kembali
        </a>
    </div>
</div>

{{-- ================= EMPTY ================= --}}
@if($buku->count() == 0)
    <div class="empty-box">
        Belum ada buku di kategori ini.
    </div>
@else

{{-- ================= GRID ================= --}}
<div class="book-grid" id="bookGrid">
@foreach($buku as $b)
    <div class="book-card" data-title="{{ strtolower($b->judul) }} {{ strtolower($b->penulis) }}">

        {{-- COVER --}}
        <div class="cover-wrapper">

            @if($b->stok > 0)
                <span class="badge-stock badge-available">Tersedia</span>
            @else
                <span class="badge-stock badge-empty">Stok Habis</span>
            @endif

            <img src="{{ $b->gambar 
                ? asset('gambar_buku/'.$b->gambar) 
                : 'https://via.placeholder.com/400x600?text=No+Cover' }}">
        </div>

        {{-- INFO --}}
        <div class="book-info">
            <div class="book-title">{{ $b->judul }}</div>
            <div class="book-author">{{ $b->penulis }}</div>
        </div>

        {{-- FOOTER --}}
        <div class="book-footer">
            @if($b->stok > 0)
                <a href="{{ route('member.buku.detail', $b->id) }}" class="btn-detail">
                    Pinjam
                </a>
            @else
                <button class="btn-detail btn-disabled" disabled>
                    Tidak Tersedia
                </button>
            @endif
        </div>

    </div>
@endforeach
</div>

@endif

{{-- ================= JS ================= --}}
<script>
// Fade-in animation
document.querySelectorAll('.book-card').forEach((card,i)=>{
    setTimeout(()=>card.classList.add('show'), i*80);
});

// Search realtime
document.getElementById('searchBook').addEventListener('keyup', function(){
    let keyword = this.value.toLowerCase();
    document.querySelectorAll('.book-card').forEach(card=>{
        card.style.display = card.dataset.title.includes(keyword)
            ? 'flex'
            : 'none';
    });
});
</script>

@endsection
