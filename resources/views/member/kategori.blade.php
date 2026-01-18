@extends('member.layout2')

@section('content')

<style>
:root{
    --dark:#0f172a;
    --muted:#64748b;
    --border:#e5e7eb;
    --primary:#2563eb;
    --bg:#f8fafc;
}

/* ================= HEADER ================= */
.page-header{
    margin-bottom:32px;
}

.page-title{
    font-size:28px;
    font-weight:800;
    color:var(--dark);
    margin-bottom:4px;
}

.page-subtitle{
    font-size:14px;
    color:var(--muted);
}

/* ================= SEARCH ================= */
.search-input{
    max-width:260px;
    border-radius:12px;
    font-size:14px;
    padding:10px 14px;
    border:1px solid var(--border);
}
.search-input:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 .2rem rgba(37,99,235,.15);
}

/* ================= GRID ================= */
.kategori-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
    gap:24px;
}

/* ================= CARD ================= */
.kategori-card{
    background:#fff;
    border-radius:20px;
    padding:26px 26px 28px;
    border:1px solid var(--border);
    transition:.35s ease;
    display:flex;
    flex-direction:column;
    position:relative;
    overflow:hidden;
}

.kategori-card::before{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(120deg,transparent,rgba(37,99,235,.05));
    opacity:0;
    transition:.35s ease;
}

.kategori-card:hover::before{
    opacity:1;
}

.kategori-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 40px rgba(0,0,0,.08);
    border-color:#dbe3f0;
}

/* ================= TEXT ================= */
.kategori-name{
    font-size:18px;
    font-weight:700;
    color:var(--dark);
}

.kategori-meta{
    font-size:13px;
    color:var(--muted);
    margin-top:6px;
}

/* ================= LINK ================= */
.kategori-link{
    margin-top:auto;
    display:inline-flex;
    align-items:center;
    gap:8px;
    font-size:13px;
    font-weight:600;
    color:var(--primary);
    text-decoration:none;
    padding-top:18px;
}

.kategori-link span{
    transition:.25s ease;
}

.kategori-card:hover .kategori-link span{
    transform:translateX(4px);
}

/* ================= EMPTY ================= */
.empty{
    text-align:center;
    color:var(--muted);
    margin-top:80px;
    font-size:15px;
}
</style>

{{-- ================= HEADER ================= --}}
<div class="d-flex justify-content-between align-items-center page-header">
    <div>
        <div class="page-title">Kategori Buku</div>
        <div class="page-subtitle">
            Telusuri koleksi berdasarkan kategori
        </div>
    </div>

    <input 
        type="text" 
        id="searchKategori"
        class="form-control search-input"
        placeholder="Cari kategori..."
    >
</div>

{{-- ================= EMPTY ================= --}}
@if($kategori->count() == 0)
    <div class="empty">
        Belum ada kategori tersedia
    </div>
@else

{{-- ================= GRID ================= --}}
<div class="kategori-grid" id="kategoriContainer">
@foreach ($kategori as $k)
    <div class="kategori-item">
        <div class="kategori-card">

            <div>
                <div class="kategori-name">
                    {{ $k->nama_kategori }}
                </div>

                <div class="kategori-meta">
                    {{ $k->buku_count }} buku
                </div>
            </div>

            <a href="{{ route('member.kategori.buku', $k->id) }}" class="kategori-link">
                Lihat Buku <span>→</span>
            </a>

        </div>
    </div>
@endforeach
</div>

@endif

<script>
document.getElementById('searchKategori').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    document.querySelectorAll('.kategori-item').forEach(item=>{
        item.style.display = item.innerText.toLowerCase().includes(keyword) ? '' : 'none';
    });
});
</script>

@endsection
