@extends('admin.layout')

@section('content')

<style>
:root{
    --dark:#0f172a;
    --muted:#64748b;
    --border:#e5e7eb;
    --bg:#f8fafc;
}

/* ================= PAGE ================= */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}
.page-title{
    font-size:26px;
    font-weight:800;
    color:var(--dark);
}

/* ================= SEARCH ================= */
.search-box{
    position:relative;
    width:280px;
}
.search-box input{
    padding-left:40px;
    border-radius:12px;
    border:1px solid var(--border);
    font-size:14px;
}
.search-box i{
    position:absolute;
    top:50%;
    left:14px;
    transform:translateY(-50%);
    color:var(--muted);
    font-size:14px;
}

/* ================= CARD ================= */
.card-modern{
    background:#fff;
    border-radius:20px;
    box-shadow:0 16px 40px rgba(0,0,0,.08);
    overflow:hidden;
}

/* ================= TABLE ================= */
.table{
    margin-bottom:0;
}
.table thead th{
    background:#111827;
    color:#e5e7eb;
    font-size:12px;
    letter-spacing:.08em;
    text-transform:uppercase;
    border:none;
    padding:14px;
}
.table tbody tr{
    transition:.2s ease;
}
.table tbody tr:hover{
    background:#f9fafb;
}
.table tbody td{
    font-size:14px;
    padding:14px;
    vertical-align:middle;
    border-top:1px solid var(--border);
}

/* ================= BADGE ================= */
.badge-days{
    font-size:12px;
    padding:6px 14px;
    border-radius:999px;
    font-weight:700;
}
.badge-safe{
    background:#ecfdf5;
    color:#047857;
}
.badge-warning{
    background:#fff7ed;
    color:#c2410c;
}
.badge-danger{
    background:#fef2f2;
    color:#b91c1c;
}

/* ================= BUTTON ================= */
.btn-action{
    border-radius:10px;
    font-size:13px;
    font-weight:600;
    padding:6px 14px;
    border:none;
}
.btn-detail{
    background:#f1f5f9;
    color:#0f172a;
}
.btn-detail:hover{
    background:#e5e7eb;
}
.btn-done{
    background:#dcfce7;
    color:#166534;
}
.btn-done:hover{
    background:#bbf7d0;
}

/* ================= EMPTY ================= */
.alert-info{
    border-radius:14px;
}
</style>

<div class="container">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="page-title">Peminjaman Aktif</div>

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" class="form-control"
                   placeholder="Cari member / buku / email">
        </div>
    </div>

    <div class="card-modern">

        @if($pinjaman->isEmpty())
            <div class="alert alert-info text-center m-4">
                Tidak ada peminjaman aktif.
            </div>
        @else

        <div class="table-responsive">
            <table class="table align-middle" id="pinjamanTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member</th>
                        <th>Email</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Deadline</th>
                        <th>Sisa Hari</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($pinjaman as $i => $p)
                    @php
                        $sisaHari = \Carbon\Carbon::now()->startOfDay()
                            ->diffInDays(
                                \Carbon\Carbon::parse($p->tgl_kembali)->startOfDay(),
                                false
                            );
                    @endphp

                    <tr>
                        <td class="text-muted">{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ $p->user->nama }}</td>
                        <td class="text-muted">{{ $p->user->email }}</td>
                        <td>{{ $p->buku->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}</td>
                        <td class="fw-semibold text-danger">
                            {{ \Carbon\Carbon::parse($p->tgl_kembali)->format('d M Y') }}
                        </td>

                        <td>
                            @if($sisaHari > 3)
                                <span class="badge-days badge-safe">{{ $sisaHari }} hari</span>
                            @elseif($sisaHari > 0)
                                <span class="badge-days badge-warning">{{ $sisaHari }} hari</span>
                            @else
                                <span class="badge-days badge-danger">Terlambat</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.peminjaman.detail', $p->id) }}"
                                   class="btn-action btn-detail">
                                    Detail
                                </a>

                                <form action="{{ route('admin.peminjaman.selesaikan', $p->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Pindahkan ke halaman pengembalian?')">
                                    @csrf
                                    <button class="btn-action btn-done">
                                        Selesai
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        @endif

    </div>
</div>

{{-- SEARCH JS --}}
<script>
document.getElementById('searchInput').addEventListener('keyup', function(){
    let value = this.value.toLowerCase();
    document.querySelectorAll('#pinjamanTable tbody tr').forEach(row=>{
        row.style.display = row.innerText.toLowerCase().includes(value)
            ? ''
            : 'none';
    });
});
</script>

@endsection
