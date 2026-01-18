@extends('admin.layout')

@section('content')
<div class="container py-4">

    {{-- BACK --}}
    <a href="{{ route('admin.buku.index') }}"
       class="btn btn-outline-secondary mb-4 rounded-pill">
        ← Kembali
    </a>

    <div class="row g-4">

        {{-- COVER --}}
        <div class="col-lg-4">
            <div class="card book-cover-card">

                <div class="cover-wrapper">

                    @php
                        $gambar = $buku->gambar
                            ? asset('gambar_buku/'.$buku->gambar)
                            : 'https://via.placeholder.com/400x600?text=No+Image';
                    @endphp

                    <img src="{{ $gambar }}"
                         alt="Cover Buku"
                         onerror="this.src='https://via.placeholder.com/400x600?text=No+Image'">
                </div>

                <div class="card-body text-center">
                    <h5 class="fw-bold mb-1">{{ $buku->judul }}</h5>
                    <p class="text-muted mb-2">{{ $buku->penulis }}</p>

                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                        {{ $buku->kategori->nama_kategori }}
                    </span>

                    <div class="stok-box mt-3">
                        Stok: <strong>{{ $buku->stok }}</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- DETAIL --}}
        <div class="col-lg-8">
            <div class="card detail-card h-100">

                <div class="card-header detail-header">
                    📘 Detail Informasi Buku
                </div>

                <div class="card-body">

                    <div class="detail-row">
                        <span>Judul</span>
                        <strong>{{ $buku->judul }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Penulis</span>
                        <strong>{{ $buku->penulis }}</strong>
                    </div>

                    <div class="detail-row">
                        <span>Kategori</span>
                        <strong>{{ $buku->kategori->nama_kategori }}</strong>
                    </div>

                    <div class="action-buttons mt-4">
                        <a href="{{ route('admin.buku.edit', $buku->id) }}"
                           class="btn btn-warning rounded-pill px-4">
                            ✏️ Edit Buku
                        </a>

                        @if($buku->link_pdf)
                            <a href="{{ $buku->link_pdf }}"
                               target="_blank"
                               class="btn btn-primary rounded-pill px-4">
                                📄 Lihat Buku
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- ================= CSS ================= --}}
<style>
body{background:#f4f6fb}

.book-cover-card{
    border:none;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 12px 30px rgba(0,0,0,.1)
}

.cover-wrapper{
    height:420px;
    background:#eee;
    overflow:hidden
}

.cover-wrapper img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.4s
}

.book-cover-card:hover img{
    transform:scale(1.05)
}

.stok-box{
    background:#eef3ff;
    padding:10px;
    border-radius:14px;
    color:#3b5bfd;
    font-weight:600
}

.detail-card{
    border:none;
    border-radius:22px;
    box-shadow:0 12px 30px rgba(0,0,0,.1)
}

.detail-header{
    background:linear-gradient(135deg,#4A78F6,#6AB7FF);
    color:white;
    font-size:18px;
    font-weight:600;
    padding:18px 24px
}

.detail-row{
    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px dashed #e3e6f0
}

.detail-row span{color:#6c757d}

.detail-desc{margin-top:18px}

.detail-desc p{
    background:#f8f9ff;
    padding:15px;
    border-radius:14px;
    line-height:1.7
}

.action-buttons{
    display:flex;
    gap:12px;
    flex-wrap:wrap
}
</style>

{{-- ================= JS ================= --}}
<script>
document.addEventListener("DOMContentLoaded",()=>{
    document.querySelectorAll('.detail-row,.detail-desc').forEach((el,i)=>{
        el.style.opacity=0;
        el.style.transform='translateY(10px)';
        setTimeout(()=>{
            el.style.transition='.3s';
            el.style.opacity=1;
            el.style.transform='translateY(0)';
        },i*80);
    });
});
</script>
@endsection
