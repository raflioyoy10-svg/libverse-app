<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin • LibVerse</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Cover.png') }}">

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ICON --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --dark:#0f172a;
            --muted:#64748b;
            --primary:#2563eb;
            --bg:#f1f5f9;
            --line:#e5e7eb;
        }

        *{
            box-sizing:border-box;
        }

        body{
            margin:0;
            font-family:'Inter',sans-serif;
            background:var(--bg);
            color:#111827;
            overflow:hidden; /* ⬅️ PENTING */
        }

        /* ================= TOPBAR ================= */
        .topbar{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:72px;
            background:rgba(255,255,255,.9);
            backdrop-filter:blur(14px);
            border-bottom:1px solid var(--line);
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 32px;
            z-index:1000;
        }

        .topbar-left{
            display:flex;
            align-items:center;
            gap:14px;
        }

        .topbar-left img{
            width:40px;
            height:40px;
        }

        .topbar-title{
            font-size:18px;
            font-weight:800;
            color:var(--dark);
        }

        .profile-box{
            display:flex;
            align-items:center;
            gap:10px;
            font-size:14px;
            font-weight:600;
            color:var(--muted);
        }

        /* ================= SIDEBAR ================= */
        .sidebar{
            position:fixed;
            top:72px;
            left:0;
            width:270px;
            height:calc(100vh - 72px);
            background:#020617;
            padding:26px 20px;
            color:#cbd5f5;
            overflow-y:auto; /* ⬅️ SIDEBAR SCROLL */
        }

        /* scrollbar sidebar */
        .sidebar::-webkit-scrollbar{
            width:6px;
        }
        .sidebar::-webkit-scrollbar-thumb{
            background:rgba(255,255,255,.15);
            border-radius:10px;
        }

        .menu-title{
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:1px;
            opacity:.6;
            margin:18px 0 12px;
        }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:14px;
            padding:12px 16px;
            border-radius:16px;
            font-size:14px;
            color:#cbd5f5;
            text-decoration:none;
            transition:.25s ease;
            margin-bottom:6px;
        }

        .sidebar a i{
            font-size:15px;
            width:18px;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,.08);
            color:#ffffff;
        }

        .sidebar a.active{
            background:rgba(37,99,235,.22);
            color:#ffffff;
            font-weight:700;
        }

        .sidebar hr{
            border-color:rgba(255,255,255,.1);
            margin:20px 0;
        }

        /* ================= CONTENT ================= */
        .content{
            margin-left:270px;
            margin-top:72px;
            height:calc(100vh - 72px);
            padding:36px;
            overflow-y:auto; /* ⬅️ CONTENT SCROLL */
        }

        .content::-webkit-scrollbar{
            width:8px;
        }

        .content::-webkit-scrollbar-thumb{
            background:#cbd5e1;
            border-radius:10px;
        }

        /* ================= LOGOUT ================= */
        .btn-logout{
            width:100%;
            background:none;
            border:none;
            padding:12px 16px;
            border-radius:16px;
            text-align:left;
            color:#cbd5f5;
            font-size:14px;
            transition:.25s;
        }

        .btn-logout:hover{
            background:rgba(239,68,68,.18);
            color:#fecaca;
        }
    </style>
</head>
<body>

{{-- ================= TOPBAR ================= --}}
<div class="topbar">
    <div class="topbar-left">
        <img src="{{ asset('images/Cover.png') }}" alt="LibVerse">
        <div class="topbar-title">LibVerse Admin</div>
    </div>

    <div class="profile-box">
        <i class="fa-solid fa-user-shield"></i>
        Admin
    </div>
</div>

{{-- ================= SIDEBAR ================= --}}
<div class="sidebar">

    <div class="menu-title">Menu</div>

    <a href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-chart-line"></i>
        Dashboard
    </a>

    <a href="{{ route('admin.buku.index') }}">
        <i class="fa-solid fa-box"></i>
        Daftar Buku
    </a>

    <a href="{{ route('buku.create') }}">
        <i class="fa-solid fa-book"></i>
        Tambah Buku
    </a>

    <a href="{{ route('admin.laporan.populer') }}">
        <i class="fa-solid fa-fire"></i>
        Buku Terpopuler
    </a>

    <a href="{{ route('admin.ulasan.index') }}">
        <i class="fa-solid fa-star"></i>
        Ulasan
    </a>

    <hr>

    <div class="menu-title">Konfirmasi</div>

    <a href="{{ route('admin.peminjaman.index') }}">
        <i class="fa-solid fa-hand-holding"></i>
        Peminjaman
    </a>

    <a href="{{ route('admin.peminjaman.daftar') }}">
        <i class="fa-solid fa-users"></i>
        Daftar Peminjam
    </a>

    <a href="{{ route('admin.pengembalian') }}">
        <i class="fa-solid fa-rotate-left"></i>
        Konfirmasi Pengembalian
    </a>

    <a href="{{ route('admin.denda') }}">
        <i class="fa-solid fa-clock"></i>
        Member Deadline
    </a>

    <hr>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket me-2"></i>
            Logout
        </button>
    </form>

</div>

{{-- ================= CONTENT ================= --}}
<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
