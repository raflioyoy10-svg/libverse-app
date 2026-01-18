<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LibVerse</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/Cover.png') }}">

    <style>
        :root{
            --bg:#f8fafc;
            --card:#ffffff;
            --text:#0f172a;
            --muted:#64748b;
            --border:#e5e7eb;
            --primary:#1e293b;
        }

        *{
            box-sizing:border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            margin: 0;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
        }

        .box {
            width: 380px;
            padding: 32px 30px;
            background: var(--card);
            border-radius: 18px;
            border: 1px solid var(--border);
            box-shadow: 0 20px 40px rgba(15,23,42,.08);
            animation: fadeIn .6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 22px;
            font-weight: 600;
            font-size: 22px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            margin-top: 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            outline: none;
            font-size: 14px;
            transition: .2s;
        }

        input::placeholder {
            color: var(--muted);
        }

        input:focus{
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30,41,59,.08);
        }

        button {
            margin-top: 22px;
            width: 100%;
            padding: 12px;
            background: var(--primary);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: .25s;
        }

        button:hover {
            background: #020617;
            transform: translateY(-1px);
        }

        .alert {
            margin-top: 14px;
            font-size: 13px;
            background: #fef2f2;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .login-link {
            margin-top: 18px;
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media(max-width:480px){
            .box{
                width: 100%;
                padding: 26px 22px;
            }
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Daftar Akun</h2>

    @if ($errors->any())
        <div class="alert">
            @foreach($errors->all() as $err)
                • {{ $err }} <br>
            @endforeach
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama lengkap" autocomplete="name" required>
        <input type="email" name="email" placeholder="Email" autocomplete="email" required>
        <input type="password" name="password" placeholder="Password (min 6 karakter)" autocomplete="new-password" required>

        <button type="submit">Buat Akun</button>

        <div class="login-link">
            Sudah punya akun? <a href="/login">Login</a>
        </div>
    </form>
</div>

</body>
</html>
