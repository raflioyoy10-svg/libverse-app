@extends('admin.layout')

@section('content')

<style>
:root{
    --primary:#2563eb;
    --success:#22c55e;
    --danger:#ef4444;
    --warning:#f59e0b;
    --muted:#64748b;
    --border:#e5e7eb;
}
.table-card{
    background:#fff;
    border-radius:22px;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
    padding:26px;
}
.page-title{
    font-size:28px;
    font-weight:800;
    margin-bottom:6px;
}
.page-subtitle{
    color:var(--muted);
    margin-bottom:24px;
}
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
.badge{
    padding:6px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}
.badge-wait{ background:#fff7ed; color:#c2410c; }
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
.btn-action:hover{
    opacity:.9;
}
</style>

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

<div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" id="search" placeholder="Cari nama member atau judul buku...">
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
    <th class="text-center">Jaminan</th>
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

    <td class="text-center">{{ $p->tgl_pinjam->format('d M Y') }}</td>

    <td class="text-center">
        {{ $p->tgl_kembali ? $p->tgl_kembali->format('d M Y') : '-' }}
    </td>

    <td class="text-center">{{ $durasi ? $durasi.' hari' : '-' }}</td>

    <td class="text-center fw-semibold">
        @if($sisa === null)
            -
        @elseif($sisa < 0)
            <span class="text-danger">Kadaluarsa</span>
        @else
            {{ ceil($sisa) }} hari
        @endif
    </td>

    {{-- 🔥 JAMINAN AUTO UPDATE --}}
    <td class="text-center">
        <form action="{{ route('admin.peminjaman.updateJaminan',$p->id) }}" method="POST">
        @csrf
        <select name="jaminan" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="ktp" {{ $p->jaminan == 'ktp' ? 'selected' : '' }}>KTP</option>
            <option value="sim" {{ $p->jaminan == 'sim' ? 'selected' : '' }}>SIM</option>
            <option value="kartu_pelajar" {{ $p->jaminan == 'kartu_pelajar' ? 'selected' : '' }}>Kartu Pelajar</option>
        </select>
        </form>
    </td>

    <td class="text-center">
        <span class="badge badge-wait">Menunggu</span>
    </td>

    <td class="text-center">
        <form action="{{ route('admin.peminjaman.setujui',$p->id) }}" method="POST" class="d-flex gap-2 justify-content-center">
            @csrf

            <select name="jaminan" class="form-select form-select-sm" required>
                <option value="ktp" {{ $p->jaminan == 'ktp' ? 'selected' : '' }}>KTP</option>
                <option value="sim" {{ $p->jaminan == 'sim' ? 'selected' : '' }}>SIM</option>
                <option value="kartu_pelajar" {{ $p->jaminan == 'kartu_pelajar' ? 'selected' : '' }}>Kartu Pelajar</option>
            </select>

            <button class="btn-action btn-approve" type="submit">
                <i class="fa-solid fa-check"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>
@endif

<script>
document.getElementById('search').addEventListener('keyup', function(){
    let filter = this.value.toLowerCase();
    document.querySelectorAll('#pinjamTable tbody tr').forEach(row=>{
        row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
    });
});
</script>

@endsection
