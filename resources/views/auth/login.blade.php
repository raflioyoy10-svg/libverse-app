<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LibVerse</title>

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
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            padding: 16px;
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

        h3 {
            text-align: center;
            margin-bottom: 22px;
            font-weight: 600;
            font-size: 21px;
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
            padding: 10px 12px;
            border-radius: 10px;
            text-align: center;
        }

        .alert.error{
            color: #b91c1c;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .alert.success{
            color: #166534;
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
        }

        .register-link {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: var(--muted);
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
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
    <h3>Login ke LibVerse</h3>

    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" autocomplete="username" required>
        <input type="password" name="password" placeholder="Password" autocomplete="current-password" required>

        <button type="submit">Masuk</button>
    </form>

    <div class="register-link">
        Belum punya akun? <a href="/register">Daftar sekarang</a>
    </div>
</div>

</body>
</html>
