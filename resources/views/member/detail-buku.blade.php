@extends('member.layout2')

@section('content')

<style>
/* Wrapper utama */
.detail-wrapper{
    max-width:900px;
    margin:40px auto;
    padding:0 16px;
}

/* Grid untuk cover + info */
.detail-box{
    display:grid;
    grid-template-columns:280px 1fr;
    gap:32px;
    background:#fff;
    padding:32px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,0.08);
}

/* Cover buku */
.book-cover{
    width:100%;
    aspect-ratio:2/3;
    border-radius:16px;
    overflow:hidden;
    background:#f0f2f5;
}
.book-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* Info buku */
.book-title{
    font-size:26px;
    font-weight:700;
    margin-bottom:12px;
    color:#1f2937;
}
.book-meta{
    font-size:14px;
    color:#4b5563;
    margin-bottom:8px;
}
.stock{
    display:inline-block;
    margin-top:10px;
    font-size:12px;
    padding:6px 12px;
    border-radius:12px;
    background:#eef2f7;
    color:#1f2937;
    font-weight:600;
}

/* Select */
.form-control{
    padding:10px 12px;
    border-radius:10px;
    border:1px solid #d1d5db;
    width:100%;
    margin-top:6px;
    font-size:14px;
}

/* Tombol */
.btn-primary{
    margin-top:20px;
    padding:14px;
    width:100%;
    border:none;
    border-radius:12px;
    background:#3b82f6;
    color:#fff;
    font-weight:600;
    font-size:15px;
}
.btn-primary:disabled{
    background:#9ca3af;
}

/* Link kembali */
.back-link{
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:14px;
    font-weight:600;
    color:#1f2937;
    text-decoration:none;
    margin-bottom:24px;
}
</style>

<div class="detail-wrapper">

    <a href="{{ url()->previous() }}" class="back-link">← Kembali</a>

    <div class="detail-box">

        <!-- Cover -->
        <div class="book-cover">
            <img src="{{ $buku->gambar ? asset('gambar_buku/'.$buku->gambar) : 'https://via.placeholder.com/400x600?text=No+Cover' }}">
        </div>

        <!-- Info -->
        <div>
            <div class="book-title">{{ $buku->judul }}</div>

            <div class="book-meta"><strong>Penulis:</strong> {{ $buku->penulis }}</div>
            <div class="book-meta"><strong>Kategori:</strong> {{ $buku->kategori->nama_kategori ?? '-' }}</div>

            <div class="stock">
                {{ $buku->stok > 0 ? 'Stok tersedia: '.$buku->stok : 'Stok habis' }}
            </div>

            @auth
            <form action="{{ route('member.pinjam', $buku->id) }}" method="POST">
                @csrf

                {{-- DURASI --}}
                <label style="font-size:14px;font-weight:600;margin-top:16px;display:block">
                    Pilih Durasi Peminjaman
                </label>
                <select name="masa_pinjam" class="form-control" required {{ $sedangDipinjam ? 'disabled' : '' }}>
                    <option value="">-- Pilih Lama Pinjam --</option>
                    @for($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}">{{ $i }} Hari</option>
                    @endfor
                </select>

                {{-- JAMINAN --}}
                <label style="font-size:14px; font-weight:600; display:block; margin-top:16px;">
                    Pilih Jaminan
                </label>

                <select name="jaminan"
                        required
                        class="form-control"
                        {{ $sedangDipinjam ? 'disabled' : '' }}
                        style="padding:10px 12px;border-radius:10px;border:1px solid #d1d5db;width:100%;margin-top:6px;">
                    <option value="">-- Pilih Jaminan --</option>
                    <option value="ktp">KTP</option>
                    <option value="sim">SIM</option>
                    <option value="kartu_pelajar">Kartu Pelajar</option>
                </select>


                @if($sedangDipinjam)
                    <button type="button" class="btn-primary" disabled>
                        Sedang Kamu Pinjam
                    </button>
                @else
                    <button type="submit"
                            class="btn-primary"
                            {{ $buku->stok <= 0 ? 'disabled' : '' }}>
                        Ajukan Peminjaman
                    </button>
                @endif
            </form>

            <p style="margin-top:12px;font-size:13px;color:#6b7280">
                📌 Peminjaman akan diproses setelah disetujui admin
            </p>
            @endauth

        </div>

    </div>
</div>

@endsection
