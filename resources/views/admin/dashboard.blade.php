@extends('admin.layout')

@section('content')

{{-- ================= STYLE ================= --}}
<style>
:root{
    --primary:#2563eb;
    --dark:#0f172a;
    --muted:#64748b;
    --border:#e5e7eb;
    --bg:#f8fafc;
}

body{
    background:var(--bg);
}

/* ================= PAGE WRAP ================= */
.dashboard-wrap{
    padding-top:20px;
    animation:fadeUp .6s ease;
}

/* ================= STAT CARD ================= */
.stat-card{
    background:#fff;
    border-radius:20px;
    padding:24px;
    border:1px solid var(--border);
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    position:relative;
    overflow:hidden;
    transition:.35s ease;
}
.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 45px rgba(0,0,0,.12);
}

.stat-icon{
    position:absolute;
    top:18px;
    right:18px;
    width:42px;
    height:42px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#e0e7ff,#c7d2fe);
    color:#4338ca;
    font-size:20px;
}

.stat-title{
    font-size:14px;
    color:var(--muted);
    font-weight:600;
}

.stat-number{
    font-size:42px;
    font-weight:800;
    color:var(--dark);
    margin:6px 0;
}

.stat-desc{
    font-size:13px;
    color:#94a3b8;
}

/* ================= SECTION ================= */
.section-box{
    background:#fff;
    border-radius:22px;
    padding:26px;
    border:1px solid var(--border);
    box-shadow:0 10px 28px rgba(0,0,0,.06);
    margin-top:34px;
}

/* ================= LOAN GRID ================= */
.loan-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
    gap:22px;
}

.loan-card{
    background:linear-gradient(180deg,#ffffff,#f9fafb);
    border-radius:18px;
    padding:20px 22px;
    border:1px solid var(--border);
    transition:.35s ease;
    position:relative;
}
.loan-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 40px rgba(0,0,0,.1);
    background:#fff;
}

.loan-title{
    font-size:15px;
    font-weight:700;
    color:var(--dark);
    margin-bottom:6px;
}

.loan-user{
    font-size:14px;
    color:#475569;
}

.loan-date{
    font-size:12px;
    color:#94a3b8;
    margin-top:6px;
}

/* ================= BADGE ================= */
.badge-status{
    position:absolute;
    top:18px;
    right:18px;
    padding:6px 14px;
    font-size:12px;
    font-weight:700;
    border-radius:999px;
}
.badge-wait{
    background:#fff7ed;
    color:#c2410c;
}
.badge-active{
    background:#ecfdf5;
    color:#047857;
}

.loan-date div{
    line-height:1.6;
}

/* ================= ANIMATION ================= */
@keyframes fadeUp{
    from{opacity:0;transform:translateY(20px)}
    to{opacity:1;transform:translateY(0)}
}
</style>

<div class="dashboard-wrap container-fluid">

    {{-- ================= STATISTICS ================= --}}
    <div class="row g-4">

        <div class="col-xl-4 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-book"></i>
                </div>
                <p class="stat-title">Total Buku</p>
                <h2 class="stat-number">{{ $totalBuku ?? 0 }}</h2>
                <p class="stat-desc">Semua koleksi terdaftar</p>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <p class="stat-title">Peminjaman Aktif</p>
                <h2 class="stat-number">{{ $peminjamanAktif ?? 0 }}</h2>
                <p class="stat-desc">Sedang berlangsung</p>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <p class="stat-title">User Terdaftar</p>
                <h2 class="stat-number">{{ $totalUser ?? 0 }}</h2>
                <p class="stat-desc">Admin & Member</p>
            </div>
        </div>

    </div>

    {{-- ================= RECENT LOAN ================= --}}
    <div class="section-box">

        <h4 class="fw-bold mb-4 text-dark">
            Aktivitas Peminjaman Terbaru
        </h4>

        <div class="loan-grid">

            @forelse($recentPeminjaman as $p)
                <div class="loan-card">

                    @if($p->status === 'menunggu')
                        <span class="badge-status badge-wait">Menunggu</span>
                    @elseif($p->status === 'dipinjam')
                        <span class="badge-status badge-active">Dipinjam</span>
                    @endif

                    <div class="loan-title">
                        {{ $p->judul_buku }}
                    </div>

                    <div class="loan-user">
                        Peminjam: <strong>{{ $p->user_nama }}</strong>
                    </div>

                    <div class="loan-date">
    <div>
        <strong>Pinjam:</strong>
        {{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}
    </div>
    <div>
        <strong>Berakhir:</strong>
        {{ \Carbon\Carbon::parse($p->tgl_kembali)->format('d M Y') }}
    </div>
</div>


                </div>
            @empty
                <p class="text-center text-muted">
                    Belum ada aktivitas peminjaman 
                </p>
            @endforelse

        </div>

    </div>

</div>

@endsection
