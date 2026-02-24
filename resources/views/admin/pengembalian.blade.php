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

.page-title{font-size:28px;font-weight:800;margin-bottom:6px}
.page-subtitle{color:var(--muted);margin-bottom:22px}

.card-box{
    background:#fff;
    border-radius:22px;
    padding:26px;
    box-shadow:0 18px 40px rgba(0,0,0,.08);
}

.search-box{position:relative;margin-bottom:20px}
.search-box i{
    position:absolute;top:50%;left:16px;
    transform:translateY(-50%);
    color:#94a3b8;
}
.search-box input{
    width:100%;
    padding:14px 16px 14px 44px;
    border-radius:14px;
    border:1px solid var(--border);
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
}
.table-modern tbody tr{
    background:#fff;
    box-shadow:0 8px 18px rgba(0,0,0,.06);
}
.table-modern td{
    padding:14px;
    vertical-align:middle;
}

.badge-status{
    padding:6px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}
.badge-done{background:#f1f5f9;color:#475569}
.badge-danger{background:#fef2f2;color:#b91c1c}
.badge-active{background:#ecfdf5;color:#047857}

.btn-confirm{
    background:var(--primary);
    color:#fff;
    border:none;
    padding:6px 14px;
    border-radius:12px;
    font-size:12px;
    font-weight:600;
}
.btn-denda{
    background:var(--danger);
    color:#fff;
    border:none;
    padding:6px 14px;
    border-radius:12px;
    font-size:12px;
    font-weight:600;
}
</style>

<div class="mb-4">
    <div class="page-title">Manajemen Pengembalian Buku</div>
    <div class="page-subtitle">Konfirmasi pengembalian buku oleh member</div>
</div>

@if($pinjaman->isEmpty())
<p class="text-muted text-center mt-5">Tidak ada data peminjaman</p>
@else

<div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" id="search" placeholder="Cari nama member atau judul buku...">
</div>

<div class="card-box">
<div class="table-responsive">

<table class="table table-modern" id="pengembalianTable">
<thead>
<tr>
    <th>Member</th>
    <th>Buku</th>
    <th class="text-center">Deadline</th>
    <th class="text-center">Status</th>
    <th class="text-center">Kondisi Buku</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($pinjaman as $p)
@php
    $sisaHari = now()->diffInDays($p->tgl_kembali, false);
@endphp

<tr>
    <td>{{ $p->user->nama ?? '-' }}</td>
    <td>{{ $p->buku->judul ?? '-' }}</td>

    <td class="text-center">
        {{ optional($p->tgl_kembali)->format('d M Y') }}
    </td>

    <td class="text-center">
        @if($p->status === 'selesai')
            <span class="badge-status badge-done">Selesai</span>
        @else
            <span class="badge-status badge-active">Dipinjam</span>
        @endif
    </td>

    {{-- KONDISI --}}
    <td class="text-center">
        <select class="form-select form-select-sm kondisi-select">
            <option value="">Pilih</option>
            <option value="baik">Baik</option>
            <option value="rusak">Rusak</option>
            <option value="hilang">Hilang</option>
        </select>
    </td>

    {{-- AKSI --}}
    <td class="text-center">
        {{-- KONFIRMASI --}}
        <form action="{{ route('admin.pengembalian.konfirmasi', $p->id) }}" method="POST" class="form-baik d-none">
            @csrf
            <button class="btn-confirm">
                <i class="fa fa-check"></i> Konfirmasi
            </button>
        </form>

        {{-- DENDA --}}
        <a href="{{ url('/admin/verifikasi/'.$p->id) }}" class="btn-denda d-none">
            <i class="fa fa-money-bill"></i> Bayar Denda
        </a>
    </td>
</tr>
@endforeach
</tbody>
</table>

</div>
</div>
@endif

<script>
// search
document.getElementById('search').addEventListener('keyup', function(){
    let keyword = this.value.toLowerCase();
    document.querySelectorAll('#pengembalianTable tbody tr').forEach(row=>{
        row.style.display = row.innerText.toLowerCase().includes(keyword) ? '' : 'none';
    });
});

// kondisi logic
document.querySelectorAll('.kondisi-select').forEach(select=>{
    select.addEventListener('change', function(){
        const row = this.closest('tr');
        row.querySelector('.form-baik').classList.add('d-none');
        row.querySelector('.btn-denda').classList.add('d-none');

        if(this.value === 'baik'){
            row.querySelector('.form-baik').classList.remove('d-none');
        }
        if(this.value === 'rusak' || this.value === 'hilang'){
            row.querySelector('.btn-denda').classList.remove('d-none');
        }
    });
});
</script>

@endsection
