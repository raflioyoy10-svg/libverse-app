@extends('member.layout2')

@section('content')

<style>
:root{
    --dark:#0f172a;
    --muted:#64748b;
    --line:#e5e7eb;
    --primary:#2563eb;
    --glass:rgba(255,255,255,.75);
}

/* ================= TITLE ================= */
.page-title{
    font-size:26px;
    font-weight:700;
    text-align:center;
    margin-bottom:36px;
}

/* ================= FILTER ================= */
.filter-box{
    max-width:1000px;
    margin:0 auto 40px;
    display:grid;
    grid-template-columns:1fr 240px auto;
    gap:14px;
}

.filter-box input,
.filter-box select{
    padding:14px 16px;
    border-radius:14px;
    border:1px solid var(--line);
    font-size:14px;
}

.filter-box button{
    padding:14px 26px;
    border-radius:14px;
    border:none;
    background:var(--primary);
    color:#fff;
    font-weight:600;
}

/* ================= LIST ================= */
.ulasan-list{
    max-width:1100px;
    margin:auto;
    display:flex;
    flex-direction:column;
    gap:28px;
}

/* ================= CARD ================= */
.ulasan-card{
    display:grid;
    grid-template-columns:130px 1fr;
    gap:26px;
    background:var(--glass);
    backdrop-filter:blur(14px);
    border-radius:22px;
    padding:24px;
    border:1px solid var(--line);
    transition:.3s;
}

.ulasan-card:hover{
    transform:translateY(-4px);
    box-shadow:0 20px 50px rgba(0,0,0,.12);
}

/* ================= COVER ================= */
.cover{
    width:100%;
    aspect-ratio:2/3;
    border-radius:16px;
    overflow:hidden;
    background:#f1f5f9;
}

.cover img{
    width:100%;
    height:100%;
    object-fit:contain;
    background:#fff;
}

/* ================= INFO ================= */
.buku-title{
    font-size:19px;
    font-weight:700;
    color:var(--dark);
}

.kategori{
    font-size:13px;
    color:var(--muted);
    margin-bottom:12px;
}

.comment-count{
    display:inline-block;
    background:#eef2ff;
    color:#4338ca;
    font-size:12px;
    padding:6px 12px;
    border-radius:999px;
    font-weight:600;
    margin-bottom:14px;
}

/* ================= COMMENT ================= */
.comment-wrapper{
    max-height:160px;
    overflow:hidden;
    transition:.35s;
}

.comment-wrapper.open{
    max-height:380px;
    overflow:auto;
}

.ulasan-item{
    padding:12px 0;
    border-top:1px solid var(--line);
}

.ulasan-user{
    font-weight:600;
    font-size:13px;
}

.ulasan-text{
    font-size:14px;
    line-height:1.6;
}

.toggle-btn{
    margin-top:12px;
    font-size:13px;
    font-weight:600;
    color:var(--primary);
    cursor:pointer;
}

.empty{
    color:#6b7280;
    font-size:14px;
    font-style:italic;
}

/* ================= RESPONSIVE ================= */
@media (max-width:768px){

    .page-title{
        font-size:22px;
    }

    .filter-box{
        grid-template-columns:1fr;
    }

    .filter-box button{
        width:100%;
    }

    .ulasan-card{
        grid-template-columns:1fr;
        text-align:left;
    }

    .cover{
        max-width:160px;
        margin:0 auto;
    }

}
</style>

<h2 class="page-title">Ulasan Buku</h2>

<form method="GET" class="filter-box">
    <input type="text" name="search" placeholder="Cari judul buku..." value="{{ request('search') }}">
    <select name="kategori">
        <option value="">Semua Kategori</option>
        @foreach($kategori as $k)
            <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>
    <button type="submit">Cari</button>
</form>

<div class="ulasan-list">
@forelse ($buku as $b)
    <div class="ulasan-card">

        <div class="cover">
            <img src="{{ $b->gambar ? asset('gambar_buku/'.$b->gambar) : 'https://via.placeholder.com/400x600?text=No+Cover' }}">
        </div>

        <div>
            <div class="buku-title">{{ $b->judul }}</div>
            <div class="kategori">{{ $b->kategori->nama_kategori }}</div>

            <div class="comment-count">{{ $b->ulasan->count() }} komentar</div>

            <div class="comment-wrapper">
                @forelse($b->ulasan as $u)
                    <div class="ulasan-item">
                        <div class="ulasan-user">{{ $u->user->email }}</div>
                        <div class="ulasan-text">{{ $u->komentar }}</div>
                    </div>
                @empty
                    <div class="empty">Belum ada ulasan</div>
                @endforelse
            </div>

            @if($b->ulasan->count() > 3)
                <div class="toggle-btn">Lihat semua komentar</div>
            @endif
        </div>

    </div>
@empty
    <p class="empty text-center">Buku tidak ditemukan</p>
@endforelse
</div>

<script>
document.querySelectorAll('.toggle-btn').forEach(btn=>{
    btn.addEventListener('click', function(){
        let wrap = this.previousElementSibling;
        wrap.classList.toggle('open');
        this.innerText = wrap.classList.contains('open')
            ? 'Tutup komentar'
            : 'Lihat semua komentar';
    });
});
</script>

@endsection
