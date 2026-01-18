@extends('admin.layout')

@section('content')

{{-- ================= STYLE ================= --}}
<style>
:root{
    --primary:#2563eb;
    --success:#22c55e;
    --danger:#ef4444;
    --warning:#f59e0b;
    --muted:#64748b;
    --border:#e5e7eb;
}

/* CARD */
.table-card{
    background:#fff;
    border-radius:22px;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
    padding:26px;
}

/* HEADER */
.page-title{
    font-size:28px;
    font-weight:800;
    margin-bottom:6px;
}
.page-subtitle{
    color:var(--muted);
    margin-bottom:24px;
}

/* SEARCH */
.search-box{
    position:relative;
    margin-bottom:20px;
}
.search-box i{
    position:absolute;
    top:50%;
    left:16px;
    transform:translateY(-50%);
    color:#94a3b8;
}
.search-box input{
    padding:14px 16px 14px 44px;
    border-radius:14px;
    border:1px solid var(--border);
    width:100%;
}
.search-box input:focus{
    outline:none;
    border-color:var(--primary);
    box-shadow:0 0 0 3px rgba(37,99,235,.15);
}

/* TABLE */
.table-modern{
    border-collapse:separate;
    border-spacing:0 12px;
}
.table-modern thead th{
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.08em;
    color:#64748b;
    border:none;
}
.table-modern tbody tr{
    background:#fff;
    box-shadow:0 8px 18px rgba(0,0,0,.06);
    transition:.25s;
}
.table-modern tbody tr:hover{
    transform:scale(1.01);
}
.table-modern td{
    padding:14px;
    border:none;
    vertical-align:middle;
}

/* BADGE */
.badge{
    padding:6px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}
.badge-wait{ background:#fff7ed; color:#c2410c; }
.badge-ok{ background:#ecfdf5; color:#047857; }
.badge-no{ background:#fef2f2; color:#b91c1c; }

/* BUTTON */
.btn-action{
    padding:6px 14px;
    border-radius:12px;
    font-size:13px;
    font-weight:600;
    border:none;
}
.btn-approve{
    background:var(--success);
    color:#fff;
}
.btn-reject{
    background:var(--danger);
    color:#fff;
}
.btn-action:hover{
    opacity:.9;
}
</style>

{{-- ================= HEADER ================= --}}
<div class="mb-4">
    <div class="page-title"> Pengajuan Peminjaman Buku</div>
    <div class="page-subtitle">
        Kelola permintaan peminjaman dari member
    </div>
</div>

@if(session('success'))
<div class="alert alert-success rounded-xl shadow-sm">
    {{ session('success') }}
</div>
@endif

{{-- ================= SEARCH ================= --}}
<div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input 
        type="text" 
        id="search" 
        placeholder="Cari nama member atau judul buku..."
    >
</div>

@if($pinjaman->isEmpty())
<p class="text-muted text-center mt-5">Tidak ada pengajuan</p>
@else

<div class="table-card">
<div class="table-responsive">

<table class="table table-modern align-middle" id="pinjamTable">
<thead>
<tr>
    <th>Member</th>
    <th>Buku</th>
    <th class="text-center">Mulai</th>
    <th class="text-center">Berakhir</th>
    <th class="text-center">Durasi</th>
    <th class="text-center">Sisa</th>
    <th class="text-center">Status</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($pinjaman as $p)
@php
    $durasi = $p->tgl_kembali 
        ? $p->tgl_pinjam->diffInDays($p->tgl_kembali) 
        : null;

    $sisa = $p->tgl_kembali 
        ? now()->diffInDays($p->tgl_kembali, false)
        : null;
@endphp

<tr>
    <td class="fw-semibold">{{ $p->user->nama }}</td>
    <td>{{ $p->buku->judul }}</td>

    <td class="text-center">
        {{ $p->tgl_pinjam->format('d M Y') }}
    </td>

    <td class="text-center">
        {{ $p->tgl_kembali ? $p->tgl_kembali->format('d M Y') : '-' }}
    </td>

    <td class="text-center">
        {{ $durasi ? $durasi.' hari' : '-' }}
    </td>

    <td class="text-center fw-semibold">
        @if($sisa === null)
            -
        @elseif($sisa < 0)
            <span class="text-danger">Kadaluarsa</span>
        @else
            {{ ceil($sisa) }} hari
        @endif
    </td>

    <td class="text-center">
        @if($p->status == 'menunggu')
            <span class="badge badge-wait">Menunggu</span>
        @elseif($p->status == 'disetujui')
            <span class="badge badge-ok">Disetujui</span>
        @else
            <span class="badge badge-no">Ditolak</span>
        @endif
    </td>

    <td class="text-center">
        @if($p->status == 'menunggu')
        <div class="d-flex gap-2 justify-content-center">
            <form action="{{ route('admin.peminjaman.setujui',$p->id) }}" method="POST">
                @csrf
                <button class="btn-action btn-approve">
                    <i class="fa-solid fa-check"></i>
                </button>
            </form>
            <form action="{{ route('admin.peminjaman.tolak',$p->id) }}" method="POST">
                @csrf
                <button class="btn-action btn-reject">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </form>
        </div>
        @else
            <span class="text-muted">—</span>
        @endif
    </td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>
@endif

{{-- ================= SEARCH JS ================= --}}
<script>
document.getElementById('search').addEventListener('keyup', function(){
    let filter = this.value.toLowerCase();
    document.querySelectorAll('#pinjamTable tbody tr').forEach(row=>{
        row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
    });
});
</script>

@endsection
