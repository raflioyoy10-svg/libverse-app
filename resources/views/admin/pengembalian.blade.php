@extends('admin.layout')

@section('content')

<style>
:root{
    --primary:#2563eb;
    --success:#22c55e;
    --danger:#ef4444;
    --muted:#64748b;
    --border:#e5e7eb;
}

/* HEADER */
.page-title{
    font-size:28px;
    font-weight:800;
    margin-bottom:6px;
}
.page-subtitle{
    color:var(--muted);
    margin-bottom:22px;
}

/* CARD */
.card-box{
    background:#fff;
    border-radius:22px;
    padding:26px;
    box-shadow:0 18px 40px rgba(0,0,0,.08);
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
    width:100%;
    padding:14px 16px 14px 44px;
    border-radius:14px;
    border:1px solid var(--border);
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
    transition:.25s ease;
}
.table-modern tbody tr:hover{
    transform:scale(1.01);
}
.table-modern td{
    padding:14px;
    border:none;
    vertical-align:middle;
    font-size:14px;
}

/* BADGE */
.badge-status{
    padding:6px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}
.badge-done{
    background:#f1f5f9;
    color:#475569;
}
.badge-danger{
    background:#fef2f2;
    color:#b91c1c;
}
.badge-active{
    background:#ecfdf5;
    color:#047857;
}

/* BUTTON */
.btn-confirm{
    background:var(--primary);
    color:#fff;
    border:none;
    padding:6px 14px;
    border-radius:12px;
    font-size:12px;
    font-weight:600;
}
.btn-confirm:hover{
    opacity:.9;
}
</style>

{{-- ================= HEADER ================= --}}
<div class="mb-4">
    <div class="page-title"> Manajemen Pengembalian Buku</div>
    <div class="page-subtitle">
        Konfirmasi buku yang telah dikembalikan oleh member
    </div>
</div>

@if(session('success'))
<div class="alert alert-success rounded-xl shadow-sm mb-4">
    {{ session('success') }}
</div>
@endif

@if($pinjaman->isEmpty())
<p class="text-muted text-center mt-5">
    Tidak ada data peminjaman
</p>
@else

{{-- ================= SEARCH ================= --}}
<div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input 
        type="text" 
        id="search" 
        placeholder="Cari nama member atau judul buku..."
    >
</div>

<div class="card-box">
<div class="table-responsive">

<table class="table table-modern align-middle" id="pengembalianTable">
<thead>
<tr>
    <th>Member</th>
    <th>Buku</th>
    <th class="text-center">Tanggal Pinjam</th>
    <th class="text-center">Deadline</th>
    <th class="text-center">Status</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($pinjaman as $p)
@php
    $sisaHari = now()->diffInDays($p->tgl_kembali, false);
@endphp

<tr>
    <td class="fw-semibold">
        {{ $p->user->nama ?? '-' }}
    </td>

    <td>
        {{ $p->buku->judul ?? '-' }}
    </td>

    <td class="text-center">
        {{ optional($p->tgl_pinjam)->format('d M Y') }}
    </td>

    <td class="text-center">
        {{ optional($p->tgl_kembali)->format('d M Y') }}
    </td>

    <td class="text-center">
        @if($p->status === 'selesai')
            <span class="badge-status badge-done">
                Sudah Dikembalikan
            </span>
        @elseif($sisaHari < 0)
            <span class="badge-status badge-danger">
                Waktu Habis
            </span>
        @else
            <span class="badge-status badge-active">
                Dipinjam ({{ ceil($sisaHari) }} hari)
            </span>
        @endif
    </td>

    <td class="text-center">
        @if($p->status !== 'selesai')
            <form action="{{ route('admin.pengembalian.konfirmasi', $p->id) }}" method="POST">
                @csrf
                <button class="btn-confirm">
                    <i class="fa-solid fa-check"></i> Konfirmasi
                </button>
            </form>
        @else
            <span class="text-muted fst-italic">
                Selesai
            </span>
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
    let keyword = this.value.toLowerCase();
    document.querySelectorAll('#pengembalianTable tbody tr').forEach(row=>{
        row.style.display = row.innerText.toLowerCase().includes(keyword)
            ? ''
            : 'none';
    });
});
</script>

@endsection
