@extends('member.layout2')

@section('content')

<style>
:root{
    --dark:#0f172a;
    --muted:#64748b;
    --border:#e5e7eb;
    --soft:#f8fafc;
    --accent:#2563eb;
    --accent-soft:#eff6ff;
    --success:#16a34a;
}

/* ================= TITLE ================= */
.page-title{
    font-size:28px;
    font-weight:800;
    text-align:center;
    margin-bottom:40px;
    letter-spacing:.3px;
    color:var(--dark);
}

/* ================= WRAPPER ================= */
.riwayat-wrapper{
    max-width:980px;
    margin:0 auto;
}

/* ================= EMPTY ================= */
.riwayat-empty{
    text-align:center;
    color:var(--muted);
    font-size:15px;
    margin-top:80px;
}

/* ================= LIST ================= */
.riwayat-list{
    list-style:none;
    padding:0;
    margin:0;
}

/* ================= CARD ================= */
.riwayat-item{
    background:#ffffff;
    border:1px solid var(--border);
    border-radius:20px;
    padding:22px 24px;
    margin-bottom:18px;
    display:flex;
    justify-content:space-between;
    gap:24px;
    transition:.35s ease;
}
.riwayat-item:hover{
    transform:translateY(-4px);
    box-shadow:0 22px 50px rgba(15,23,42,.12);
}

/* ================= LEFT ================= */
.riwayat-content{
    display:flex;
    gap:20px;
    flex:1;
}

/* ================= COVER ================= */
.cover{
    flex-shrink:0;
}
.book-cover{
    width:90px;
    height:130px;
    border-radius:12px;
    object-fit:cover;
    background:#e5e7eb;
    box-shadow:0 8px 20px rgba(0,0,0,.18);
}

/* ================= INFO ================= */
.riwayat-info{
    display:flex;
    flex-direction:column;
    flex:1;
}
.riwayat-info strong{
    font-size:18px;
    font-weight:700;
    color:var(--dark);
    line-height:1.4;
}
.riwayat-info span{
    font-size:13px;
    color:var(--muted);
    margin-top:6px;
}

/* ================= BADGE ================= */
.riwayat-badge{
    background:var(--accent-soft);
    color:var(--accent);
    font-size:12px;
    padding:10px 18px;
    border-radius:999px;
    font-weight:700;
    height:fit-content;
}

/* ================= FORM ================= */
.ulasan-form{
    margin-top:18px;
    display:flex;
    flex-direction:column;
    gap:12px;
}
.ulasan-form textarea{
    resize:none;
    border-radius:14px;
    padding:14px;
    border:1px solid var(--border);
    font-size:14px;
    min-height:90px;
    transition:.25s ease;
}
.ulasan-form textarea:focus{
    outline:none;
    border-color:var(--accent);
    box-shadow:0 0 0 4px rgba(37,99,235,.15);
}

/* ================= BUTTON ================= */
.ulasan-form button{
    align-self:flex-start;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:999px;
    cursor:pointer;
    font-weight:600;
    font-size:13px;
    transition:.3s ease;
}
.ulasan-form button:hover{
    transform:translateY(-1px);
    box-shadow:0 10px 28px rgba(37,99,235,.4);
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .riwayat-item{
        flex-direction:column;
    }
    .riwayat-badge{
        align-self:flex-start;
    }
}
</style>

<h2 class="page-title">Riwayat Pinjaman</h2>

<div class="riwayat-wrapper">
@if($riwayat->isEmpty())
    <div class="riwayat-empty">
        Belum ada riwayat pinjaman
    </div>
@else
    <ul class="riwayat-list">
        @foreach($riwayat as $r)
        <li class="riwayat-item">

            <div class="riwayat-content">

                <!-- COVER -->
                <div class="cover">
                    <img 
                        src="{{ $r->buku->gambar 
                            ? asset('gambar_buku/'.$r->buku->gambar) 
                            : 'https://via.placeholder.com/120x180?text=No+Cover' }}"
                        class="book-cover"
                        alt="{{ $r->buku->judul }}">
                </div>

                <!-- INFO & FORM -->
                <div class="riwayat-info">
                    <strong>{{ $r->buku->judul }}</strong>
                    <span>
                        Selesai pada 
                        {{ \Carbon\Carbon::parse($r->tgl_kembali)->format('d M Y') }}
                    </span>

                    <form action="{{ route('member.ulasan.store') }}" method="POST" class="ulasan-form">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{ $r->buku->id }}">

                        <textarea 
                            name="komentar"
                            placeholder="Tulis ulasan kamu tentang buku ini..."
                            required></textarea>

                        <button type="submit">Kirim Ulasan</button>
                    </form>
                </div>

            </div>

            <div class="riwayat-badge">
                Selesai
            </div>

        </li>
        @endforeach
    </ul>
@endif
</div>

@endsection
