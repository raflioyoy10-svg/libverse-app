<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibVerse • Member</title>

    {{-- FAVICON --}}
    <link rel="icon" type="image/png" href="{{ asset('images/Cover.png') }}">

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
    --dark:#0a1020;
    --text:#0f172a;
    --muted:#64748b;
    --line:#e6eaf0;
    --primary:#1e40af;
    --bg:#f4f6fb;
    --glass:rgba(255,255,255,.82);
}

/* ================= BASE ================= */
body{
    font-family:'Inter',sans-serif;
    background:
        radial-gradient(1200px 400px at top, #eef2ff 0%, transparent 60%),
        var(--bg);
    color:var(--text);
    letter-spacing:.15px;
}

/* ================= NAVBAR ================= */
.navbar{
    background:var(--glass);
    backdrop-filter:blur(18px);
    border-bottom:1px solid var(--line);
    padding:16px 44px;
    box-shadow:0 10px 30px rgba(15,23,42,.04);
}

.navbar-brand{
    font-weight:800;
    font-size:21px;
    color:var(--dark);
    display:flex;
    align-items:center;
    gap:12px;
}

.navbar-brand img{
    width:40px;
    height:40px;
}

.navbar-nav{
    gap:8px;
}

/* ================= NAV LINK ================= */
.nav-link{
    font-size:14px;
    font-weight:500;
    color:var(--muted)!important;
    padding:10px 18px!important;
    border-radius:14px;
    transition:all .25s ease;
}

.nav-link:hover{
    background:#f8fafc;
    color:var(--dark)!important;
}

.nav-link.active{
    background:linear-gradient(135deg,#eef2ff,#ffffff);
    color:var(--primary)!important;
    font-weight:600;
    box-shadow:
        inset 0 0 0 1px #e0e7ff,
        0 8px 20px rgba(30,64,175,.08);
}

/* ================= PROFILE ================= */
.profile-box{
    display:flex;
    align-items:center;
    gap:12px;
    cursor:pointer;
    padding:6px 12px;
    border-radius:16px;
    transition:.25s;
}

.profile-box:hover{
    background:#f8fafc;
}

.profile-avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    border:2px solid #e5e7eb;
}

.profile-name{
    font-size:13px;
    font-weight:600;
    max-width:150px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

/* ================= DROPDOWN ================= */
.dropdown-menu{
    border:none;
    border-radius:18px;
    box-shadow:0 25px 60px rgba(15,23,42,.18);
    padding:10px;
}

.dropdown-item{
    font-size:14px;
    border-radius:14px;
    padding:12px 16px;
}

.dropdown-item:hover{
    background:#f1f5f9;
}

/* ================= CONTENT ================= */
.content{
    padding:48px 42px;
    min-height:calc(100vh - 100px);
}

/* ================= FOOTER ================= */
.footer{
    text-align:center;
    font-size:13px;
    color:#94a3b8;
    padding:28px 0 20px;
}

/* ===== NOTIF BADGE ===== */
.notif-badge{
    position:absolute;
    top:6px;
    right:10px;
    min-width:18px;
    height:18px;
    padding:0 5px;
    border-radius:999px;
    background:#ef4444;
    color:#fff;
    font-size:11px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:0 4px 12px rgba(239,68,68,.6);
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
    .navbar{padding:14px 20px;}
    .content{padding:34px 20px;}
}
</style>
</head>

<body>

{{-- ================= NAVBAR ================= --}}
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="/member">
            <img src="{{ asset('images/Cover.png') }}">
            LibVerse
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#memberNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="memberNav">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('member') ? 'active' : '' }}" href="/member">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('member.kategori') ? 'active' : '' }}"
                       href="{{ route('member.kategori') }}">Kategori</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('member.pinjaman') ? 'active' : '' }}"
                       href="{{ route('member.pinjaman') }}">Dipinjam</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('member.riwayat') ? 'active' : '' }}"
                       href="{{ route('member.riwayat') }}">Riwayat</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('member.ulasan') ? 'active' : '' }}"
                       href="{{ route('member.ulasan') }}">Ulasan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link position-relative {{ request()->routeIs('member.notifikasi') ? 'active' : '' }}"href="{{ route('member.notifikasi') }}">
                        Notifikasi
                        @php
                            $notifCount = \App\Models\Notifikasi::where('user_id', Auth::id())
                                            ->where('dibaca', 0)
                                            ->count();
                        @endphp

                        @if($notifCount > 0)
                            <span class="notif-badge">
                                {{ $notifCount }}
                            </span>
                        @endif
                    </a>
                </li>
            </ul>

            {{-- PROFILE --}}
            <div class="dropdown">
                <div class="profile-box dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->email) }}&background=1e40af&color=fff"
                         class="profile-avatar">
                    <span class="profile-name">{{ Auth::user()->email }}</span>
                </div>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>

{{-- ================= CONTENT ================= --}}
<div class="content container-fluid">
    @yield('content')
</div>

<div class="footer">
    © {{ date('Y') }} <strong>LibVerse</strong> — Digital Library Platform
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.nav-link').forEach(link=>{
    link.addEventListener('mouseenter',()=>link.style.transform='translateY(-2px)');
    link.addEventListener('mouseleave',()=>link.style.transform='translateY(0)');
});
</script>

</body>
</html>
