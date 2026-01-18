@extends('admin.layout')

@section('content')
<div class="container py-4">

    <h3 class="page-title mb-4">📚 Daftar Buku per Kategori</h3>

    @foreach ($kategori as $k)
        <div class="kategori-wrap mb-5">

            {{-- HEADER KATEGORI --}}
            <div class="kategori-header">
                {{ $k->nama_kategori }}
            </div>

            @if ($k->buku->count() > 0)
                <div class="row g-4 mt-1">

                    @foreach ($k->buku as $b)
                        <div class="col-xl-3 col-lg-4 col-md-6">

                            <div class="book-card {{ !$b->is_active ? 'inactive' : '' }}">

                                {{-- COVER --}}
                                <div class="cover-frame">
                                    @if($b->is_active)
                                        <img
                                            src="{{ $b->gambar ? asset('gambar_buku/'.$b->gambar) : 'https://via.placeholder.com/400x550?text=No+Cover' }}"
                                            alt="{{ $b->judul }}">
                                    @else
                                        <div class="cover-inactive">
                                            NONAKTIF
                                        </div>
                                    @endif
                                </div>

                                {{-- INFO --}}
                                <div class="book-info">
                                    <div class="book-title">
                                        {{ $b->judul }}
                                    </div>

                                    @if($b->is_active)
                                        <div class="book-author">
                                            {{ $b->penulis }}
                                        </div>

                                        <div class="stok-badge">
                                            Stok: {{ $b->stok }}
                                        </div>
                                    @else
                                        <div class="text-danger fw-semibold mt-2">
                                            Buku dinonaktifkan
                                        </div>
                                    @endif
                                </div>

                                {{-- ACTION --}}
                                <div class="book-action">
                                    @if($b->is_active)
                                        <a href="{{ route('admin.buku.detail', $b->id) }}" class="btn-outline">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.buku.edit', $b->id) }}" class="btn-outline">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.buku.delete', $b->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Nonaktifkan buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger-outline">
                                                Nonaktifkan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Tidak tersedia</span>
                                    @endif
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <p class="text-muted mt-3">Tidak ada buku di kategori ini.</p>
            @endif

        </div>
    @endforeach

</div>

{{-- ================= CSS ================= --}}
<style>
body{
    background:#f4f6fb;
}

/* PAGE TITLE */
.page-title{
    font-size:26px;
    font-weight:800;
    color:#0f172a;
}

/* KATEGORI */
.kategori-header{
    font-size:20px;
    font-weight:700;
    color:#1f2937;
    margin-bottom:16px;
}

/* BOOK CARD */
.book-card{
    background:#ffffff;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 10px 32px rgba(0,0,0,.08);
    transition:.35s ease;
    display:flex;
    flex-direction:column;
    height:100%;
}

.book-card:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 45px rgba(0,0,0,.14);
}

.book-card.inactive{
    opacity:.7;
}

/* COVER FRAME (ANTI CROP) */
.cover-frame{
    height:300px;
    background:#f1f5f9;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:14px;
}

.cover-frame img{
    max-width:100%;
    max-height:100%;
    object-fit:contain;
    border-radius:12px;
    transition:.35s ease;
}

.book-card:hover img{
    transform:scale(1.04);
}

/* COVER NONAKTIF */
.cover-inactive{
    width:100%;
    height:100%;
    border-radius:14px;
    background:#fee2e2;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    font-weight:800;
    color:#dc2626;
}

/* INFO */
.book-info{
    padding:18px 16px;
    text-align:center;
}

.book-title{
    font-size:16px;
    font-weight:700;
    color:#0f172a;
    line-height:1.4;
}

.book-author{
    font-size:14px;
    color:#64748b;
    margin-top:6px;
}

.stok-badge{
    margin-top:12px;
    display:inline-block;
    padding:6px 18px;
    border-radius:999px;
    background:#eef2ff;
    color:#4338ca;
    font-weight:700;
    font-size:13px;
}

/* ACTION */
.book-action{
    padding:14px;
    border-top:1px solid #eef0f4;
    display:flex;
    justify-content:center;
    gap:10px;
    flex-wrap:wrap;
}

.btn-outline{
    padding:7px 18px;
    border-radius:999px;
    border:1px solid #d1d5db;
    background:#fff;
    font-size:13px;
    font-weight:600;
    color:#374151;
    text-decoration:none;
}

.btn-outline:hover{
    background:#f3f4f6;
}

.btn-danger-outline{
    padding:7px 18px;
    border-radius:999px;
    border:1px solid #fecaca;
    background:#fff;
    font-size:13px;
    font-weight:600;
    color:#dc2626;
}

.btn-danger-outline:hover{
    background:#fee2e2;
}
</style>

{{-- ================= JS ================= --}}
<script>
document.addEventListener("DOMContentLoaded",()=>{
    document.querySelectorAll('.book-card').forEach((el,i)=>{
        el.style.opacity=0;
        el.style.transform='translateY(20px)';
        setTimeout(()=>{
            el.style.transition='.45s ease';
            el.style.opacity=1;
            el.style.transform='translateY(0)';
        },i*80);
    });
});
</script>
@endsection
