@extends('admin.layout')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9">

            <div class="card form-card border-0 overflow-hidden">

                {{-- HEADER --}}
                <div class="form-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle">
                            <i class="fa-solid fa-book-medical"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Tambah Buku Baru</h5>
                            <small class="opacity-75">Lengkapi data buku dengan benar</small>
                        </div>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="card-body p-4 p-md-5">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">

                            {{-- JUDUL --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Judul Buku</label>
                                <input type="text" name="judul"
                                       class="form-control form-control-lg input-soft"
                                       placeholder="Masukkan judul buku"
                                       required>
                            </div>

                            {{-- PENULIS --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Penulis</label>
                                <input type="text" name="penulis"
                                       class="form-control form-control-lg input-soft"
                                       placeholder="Nama penulis"
                                       required>
                            </div>

                            {{-- KATEGORI --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold d-flex justify-content-between">
                                    <span>Kategori</span>
                                    <a href="#" class="link-primary small text-decoration-none"
                                       data-bs-toggle="modal"
                                       data-bs-target="#modalKategori">
                                        + Tambah
                                    </a>
                                </label>

                                <select name="kategori_id"
                                        class="form-select form-select-lg input-soft"
                                        required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id }}">
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- STOK --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Stok Buku</label>
                                <input type="number" name="stok"
                                       class="form-control form-control-lg input-soft"
                                       min="1"
                                       placeholder="Jumlah stok"
                                       required>
                            </div>

                            {{-- GAMBAR --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Cover Buku</label>

                                <div class="upload-box">
                                    <input type="file"
                                           name="gambar"
                                           accept="image/png, image/jpeg"
                                           onchange="previewCover(this)">
                                    <div class="upload-placeholder" id="uploadText">
                                        <i class="fa-regular fa-image"></i>
                                        <span>Pilih gambar cover</span>
                                    </div>
                                    <img id="previewImage" />
                                </div>

                                <small class="text-muted d-block mt-2">
                                    JPG / PNG • Maks 2MB
                                </small>
                            </div>

                        </div>

                        {{-- ACTION --}}
                        <div class="d-flex justify-content-end mt-5">
                            <button class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                                <i class="fa-solid fa-save me-1"></i>
                                Simpan Buku
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- ================= MODAL TAMBAH KATEGORI ================= --}}
<div class="modal fade" id="modalKategori" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="fa-solid fa-folder-plus me-1"></i>
                    Tambah Kategori
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.kategori.quickStore') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text"
                           name="nama_kategori"
                           class="form-control input-soft"
                           placeholder="Novel, Komik, Edukasi"
                           required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- ================= CSS ================= --}}
<style>
body{ background:#f4f6fb; }

.form-card{
    border-radius:26px;
    box-shadow:0 25px 60px rgba(0,0,0,.12);
}

.form-header{
    padding:26px 30px;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
}

.icon-circle{
    width:48px;
    height:48px;
    border-radius:50%;
    background:rgba(255,255,255,.2);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.input-soft{
    border-radius:14px;
    background:#f8fafc;
    border:1px solid #e5e7eb;
}

.input-soft:focus{
    background:#fff;
    border-color:#6366f1;
    box-shadow:0 0 0 .25rem rgba(99,102,241,.15);
}

/* UPLOAD */
.upload-box{
    position:relative;
    border:2px dashed #c7d2fe;
    border-radius:18px;
    padding:26px;
    text-align:center;
    background:#eef2ff;
    cursor:pointer;
}

.upload-box input{
    position:absolute;
    inset:0;
    opacity:0;
    cursor:pointer;
}

.upload-placeholder{
    display:flex;
    flex-direction:column;
    gap:8px;
    color:#4338ca;
    font-weight:600;
}

.upload-placeholder i{
    font-size:32px;
}

.upload-box img{
    display:none;
    max-height:260px;
    margin:auto;
    border-radius:14px;
}
</style>

{{-- ================= JS ================= --}}
<script>
function previewCover(input){
    const img = document.getElementById('previewImage');
    const text = document.getElementById('uploadText');

    if(input.files && input.files[0]){
        img.src = URL.createObjectURL(input.files[0]);
        img.style.display = 'block';
        text.style.display = 'none';
    }
}
</script>
@endsection
