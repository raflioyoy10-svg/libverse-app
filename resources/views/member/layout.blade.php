<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibVerse</title>

    <link rel="icon" type="image/png" href="{{ asset('images/Cover.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            margin:0;
            font-family:'Poppins',sans-serif;
            background:#f6f7fb;
            color:#2c3e50;
        }

        /* ================= NAVBAR ================= */
        nav{
            position:sticky;
            top:0;
            z-index:100;
            background:#fff;
            padding:14px 40px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
            box-shadow:0 6px 18px rgba(0,0,0,.08);
            flex-wrap:wrap;
        }

        .nav-left{
            display:flex;
            align-items:center;
            gap:30px;
        }

        .logo{
            font-size:22px;
            font-weight:700;
            display:flex;
            align-items:center;
            gap:8px;
        }

        .logo img{
            width:32px;
            height:32px;
            object-fit:contain;
        }

        .menu{
            display:flex;
            gap:22px;
        }

        .menu a{
            text-decoration:none;
            color:#555;
            font-size:14px;
            font-weight:500;
            transition:.2s;
        }

        .menu a:hover{
            color:#3498db;
        }

        /* ================= SEARCH ================= */
        .search-box{
            position:relative;
        }

        .search-box input{
            padding:8px 14px;
            padding-right:35px;
            border-radius:20px;
            border:1px solid #ddd;
            font-size:13px;
            width:220px;
            outline:none;
        }

        .search-box span{
            position:absolute;
            right:12px;
            top:50%;
            transform:translateY(-50%);
            font-size:14px;
            color:#888;
        }

        /* ================= AUTH ================= */
        .auth-buttons{
            display:flex;
            gap:10px;
        }

        .auth-buttons a{
            text-decoration:none;
            padding:8px 18px;
            border-radius:20px;
            font-size:13px;
            font-weight:600;
        }

        .btn-login{
            border:1px solid #3498db;
            color:#3498db;
        }

        .btn-login:hover{
            background:#3498db;
            color:#fff;
        }

        .btn-register{
            background:#3498db;
            color:#fff;
        }

        .btn-register:hover{
            background:#2c80b4;
        }

        /* ================= CONTENT ================= */
        .container{
            max-width:1100px;
            margin:30px auto;
            padding:0 20px;
        }

        /* ================= MOBILE ================= */
        @media (max-width: 768px){

            nav{
                padding:12px 16px;
            }

            .nav-left{
                width:100%;
                justify-content:space-between;
            }

            .menu{
                display:none;
            }

            .search-box{
                width:100%;
                order:3;
            }

            .search-box input{
                width:100%;
            }

            .auth-buttons{
                order:2;
            }
        }
    </style>
</head>

<body>

<nav>
    <div class="nav-left">
        <div class="logo">
            <img src="{{ asset('images/Cover.png') }}" alt="">
            LibVerse
        </div>

        <div class="menu">
            <a href="{{ route('public.member') }}">Daftar Buku</a>
            <a href="{{ route('public.tentang') }}">Tentang Kami</a>
        </div>
    </div>

    <div class="search-box">
        <form action="{{ route('public.member') }}" method="GET">
            <input type="text" name="search" placeholder="Cari judul buku...">
            <span>🔍</span>
        </form>
    </div>

    <div class="auth-buttons">
        <a href="{{ route('login') }}" class="btn-login">Login</a>
        <a href="{{ route('register') }}" class="btn-register">Register</a>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
