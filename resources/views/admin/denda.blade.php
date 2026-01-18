@extends('admin.layout')

@section('content')

<style>
:root{
    --dark:#111827;
    --muted:#6b7280;
    --border:#e5e7eb;
    --soft:#f9fafb;
    --danger:#dc2626;
    --success:#16a34a;
}

/* ================= HEADER ================= */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:28px;
}
.page-title{
    font-size:28px;
    font-weight:800;
    color:var(--dark);
    display:flex;
    align-items:center;
    gap:10px;
}
.page-sub{
    font-size:14px;
    color:var(--muted);
    margin-top:4px;
}

/* ================= SEARCH ================= */
.search-box{
    position:relative;
    width:260px;
}
.search-box input{
    width:100%;
    padding:10px 14px 10px 38px;
    border-radius:12px;
    border:1px solid var(--border);
    font-size:13px;
    background:#fff;
}
.search-box svg{
    position:absolute;
    left:12px;
    top:50%;
    transform:translateY(-50%);
    width:16px;
    color:#9ca3af;
}

/* ================= TABLE ================= */
.table-wrapper{
    background:#fff;
    border-radius:18px;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
    overflow:hidden;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#fef2f2;
}
thead th{
    padding:14px;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.05em;
    color:#7f1d1d;
    text-align:left;
}

tbody tr{
    border-top:1px solid var(--border);
    transition:.25s ease;
}
tbody tr:hover{
    background:#f9fafb;
}

td{
    padding:14px;
    font-size:13px;
    vertical-align:middle;
    color:#111827;
}

/* ================= USER ================= */
.user-name{
    font-weight:700;
}
.user-email{
    font-size:12px;
    color:var(--muted);
}

/* ================= BOOK ================= */
.book-info{
    display:flex;
    align-items:center;
    gap:12px;
}
.book-info img{
    width:44px;
    height:62px;
    object-fit:cover;
    border-radius:6px;
    box-shadow:0 6px 16px rgba(0,0,0,.15);
}
.book-title{
    font-weight:600;
}

/* ================= BADGE ================= */
.badge-danger{
    background:#fee2e2;
    color:#b91c1c;
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}

.badge-money{
    font-weight:800;
    color:#991b1b;
}

/* ================= BUTTON ================= */
.btn-action{
    background:linear-gradient(135deg,#16a34a,#15803d);
    color:white;
    padding:8px 14px;
    font-size:12px;
    font-weight:700;
    border-radius:10px;
    transition:.25s ease;
}
.btn-action:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 22px rgba(0,0,0,.18);
}
</style>

{{-- ================= HEADER ================= --}}
<div class="page-header">
    <div>
        <div class="page-title">💸 Data Denda Member</div>
        <div class="page-sub">Daftar keterlambatan pengembalian buku</div>
    </div>

    <div class="search-box">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
        </svg>
        <input type="text" id="searchDenda" placeholder="Cari nama / buku / email...">
    </div>
</div>

@if($denda->isEmpty())
    <p class="text-gray-500">Tidak ada member yang terkena denda</p>
@else

<div class="table-wrapper">
<table id="dendaTable">
    <thead>
        <tr>
            <th>Member</th>
            <th>Buku</th>
            <th class="text-center">Deadline</th>
            <th class="text-center">Telat</th>
            <th class="text-center">Denda</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($denda as $p)
        <tr>
            {{-- MEMBER --}}
            <td>
                <div class="user-name">{{ $p->user->nama }}</div>
                <div class="user-email">{{ $p->user->email }}</div>
            </td>

            {{-- BUKU --}}
            <td>
                <div class="book-info">
                    <img src="{{ $p->buku->gambar 
                        ? asset('gambar_buku/'.$p->buku->gambar)
                        : 'https://via.placeholder.com/100x150?text=No+Cover' }}">
                    <div class="book-title">{{ $p->buku->judul }}</div>
                </div>
            </td>

            {{-- DEADLINE --}}
            <td class="text-center">
                {{ $p->tgl_kembali->format('d M Y') }}
            </td>

            {{-- TELAT --}}
            <td class="text-center">
                <span class="badge-danger">
                    {{ ceil($p->hari_telat) }} hari
                </span>
            </td>

            {{-- DENDA --}}
            <td class="text-center badge-money">
                Rp {{ number_format(round($p->total_denda), 0, ',', '.') }}
            </td>


            {{-- AKSI --}}
            <td class="text-center">
                <form action="{{ route('admin.denda.konfirmasi', $p->id) }}" method="POST">
                    @csrf
                    <button class="btn-action">
                        ✔ Bayar & Dikembalikan
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endif

<script>
document.getElementById('searchDenda').addEventListener('keyup', function(){
    let keyword = this.value.toLowerCase();
    document.querySelectorAll('#dendaTable tbody tr').forEach(row=>{
        row.style.display = row.innerText.toLowerCase().includes(keyword) ? '' : 'none';
    });
});
</script>

@endsection
