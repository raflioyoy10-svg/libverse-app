@extends('member.layout')

@section('content')

<style>
.about-wrapper{
    max-width:900px;
    margin:40px auto 80px;
    padding:0 20px;
}

/* HERO */
.about-hero{
    text-align:center;
    margin-bottom:50px;
}

.about-hero h1{
    font-size:36px;
    font-weight:700;
    margin-bottom:12px;
    color:#1f2937;
}

.about-hero p{
    font-size:16px;
    color:#666;
    line-height:1.7;
    max-width:700px;
    margin:0 auto;
}

/* SECTION */
.about-section{
    background:#fff;
    border-radius:16px;
    padding:30px 32px;
    margin-bottom:30px;
    box-shadow:0 10px 28px rgba(0,0,0,.08);
}

.about-section h3{
    font-size:22px;
    margin-bottom:14px;
    color:#2c3e50;
}

.about-section p{
    font-size:15px;
    line-height:1.8;
    color:#555;
}

/* GRID FITUR */
.about-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-top:20px;
}

.feature-box{
    background:#f6f8fb;
    padding:22px 20px;
    border-radius:14px;
    text-align:center;
    transition:0.25s;
}

.feature-box:hover{
    transform:translateY(-4px);
    box-shadow:0 10px 24px rgba(0,0,0,.08);
}

.feature-box span{
    font-size:30px;
    display:block;
    margin-bottom:10px;
}

.feature-box h4{
    font-size:16px;
    margin-bottom:6px;
    color:#1f2937;
}

.feature-box p{
    font-size:13px;
    color:#666;
}

/* FOOTER */
.about-footer{
    text-align:center;
    margin-top:40px;
    font-size:14px;
    color:#777;
}

/* ================= RESPONSIVE ================= */
@media (max-width:768px){
    .about-hero h1{
        font-size:26px;
    }

    .about-hero p{
        font-size:14px;
    }

    .about-section{
        padding:22px 20px;
    }

    .about-section h3{
        font-size:18px;
    }

    .about-section p,
    .about-section li{
        font-size:14px;
    }

    .about-footer{
        font-size:13px;
        padding:0 10px;
    }
}
</style>

<div class="about-wrapper">

    {{-- HERO --}}
    <div class="about-hero">
        <h1>Tentang LibVerse</h1>
        <p>
            LibVerse adalah platform perpustakaan digital yang dirancang untuk memudahkan
            pengguna dalam membaca, meminjam, dan mengelola buku secara online
            dengan sistem yang modern, aman, dan efisien.
            Disini kami menyediakan berbagai buku secara gratis untuk semua kalangan.
        </p>
    </div>

    {{-- PROFIL --}}
    <div class="about-section">
        <h3>Siapa Kami?</h3>
        <p>
            LibVerse hadir sebagai solusi perpustakaan digital di era modern.
            Kami menyediakan akses buku secara online tanpa batasan ruang dan waktu,
            sehingga pengguna dapat menikmati pengalaman membaca yang praktis dan nyaman.
        </p>
    </div>

    {{-- VISI MISI --}}
    <div class="about-section">
        <h3>Visi & Misi</h3>

        <p><strong>Visi:</strong><br>
        Menjadi platform perpustakaan digital yang modern, mudah diakses,
        dan mendukung budaya literasi.</p>

        <p><strong>Misi:</strong></p>
        <ul style="padding-left:18px; color:#555; line-height:1.8;">
            <li>Menyediakan sistem peminjaman buku digital yang efisien</li>
            <li>Mendukung pembelajaran melalui akses literasi online</li>
            <li>Menghadirkan pengalaman membaca yang aman dan nyaman</li>
        </ul>
    </div>

    {{-- FITUR --}}
    <div class="about-section">
        <h3>Fitur Unggulan</h3>

        <div class="about-grid">
            <div class="feature-box">
                <span>📘</span>
                <h4>Peminjaman Digital</h4>
                <p>Pinjam buku dengan batas waktu otomatis</p>
            </div>

            <div class="feature-box">
                <span>⏳</span>
                <h4>Batas Waktu Akses</h4>
                <p>Akses buku sesuai masa pinjam</p>
            </div>

            <div class="feature-box">
                <span>📚</span>
                <h4>Kategori Buku</h4>
                <p>Pencarian buku lebih terstruktur</p>
            </div>

            <div class="feature-box">
                <span>💬</span>
                <h4>Ulasan Pembaca</h4>
                <p>Berbagi pendapat & pengalaman membaca</p>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="about-footer">
        © {{ date('Y') }} <strong>LibVerse</strong> — Digital Library for Everyone<br>
        Mochammad Rafli | XII RPL I
    </div>

</div>

@endsection
