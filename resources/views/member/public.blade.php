@extends('member.layout')

@section('content')

<style>
/* ===== TITLE ===== */
.page-header{
    text-align:center;
    margin:50px 0 35px;
}

.page-header h2{
    font-size:30px;
    font-weight:800;
    color:#1f2937;
}

.page-header p{
    font-size:14px;
    color:#6b7280;
    margin-top:6px;
}

/* ===== GRID ===== */
.book-grid{
    max-width:1200px;
    margin:0 auto 60px;
    padding:0 24px;
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(210px,1fr));
    gap:30px;
}

/* ===== CARD ===== */
.book-card{
    background:rgba(255,255,255,.85);
    backdrop-filter:blur(8px);
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 28px rgba(0,0,0,.08);
    transition:.35s;
    display:flex;
    flex-direction:column;
}

.book-card:hover{
    transform:translateY(-8px);
    box-shadow:0 18px 40px rgba(0,0,0,.15);
}

/* ===== IMAGE ===== */
.book-cover{
    width:100%;
    height:300px;
    object-fit:cover;
}

/* ===== BODY ===== */
.book-body{
    padding:16px;
    display:flex;
    flex-direction:column;
    flex-grow:1;
}

.book-title{
    font-size:16px;
    font-weight:700;
    color:#111827;
    line-height:1.4;
    margin-bottom:4px;

    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

.book-author{
    font-size:13px;
    color:#6b7280;
    margin-bottom:auto;
}

/* ===== BUTTON ===== */
.btn-login-pinjam{
    margin-top:18px;
    padding:11px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg,#3b82f6,#2563eb);
    color:#fff;
    font-size:14px;
    font-weight:700;
    cursor:pointer;
    transition:.3s;
}

.btn-login-pinjam:hover{
    opacity:.9;
    transform:scale(1.02);
}
</style>

<div class="page-header">
    <h2>Koleksi Buku</h2>
    <p>Silakan login untuk membaca dan meminjam buku favoritmu</p>
</div>

<div class="book-grid">
@foreach ($buku as $b)
    <div class="book-card">
        <img
            class="book-cover"
            src="{{ $b->gambar ? asset('gambar_buku/'.$b->gambar) : 'https://via.placeholder.com/300x420?text=Buku' }}"
            alt="Cover Buku"
        >

        <div class="book-body">
            <div class="book-title">{{ $b->judul }}</div>
            <div class="book-author">{{ $b->penulis }}</div>

            <button 
                class="btn-login-pinjam"
                onclick="alert('Silahkan login untuk meminjam buku')">
                🔐 Login untuk Membaca
            </button>
        </div>
    </div>
@endforeach
</div>

@endsection
