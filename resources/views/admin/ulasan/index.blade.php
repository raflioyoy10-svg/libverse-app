@extends('admin.layout')

@section('content')

<style>
:root{
    --dark:#0f172a;
    --muted:#64748b;
    --line:#e5e7eb;
    --soft:#f8fafc;
    --primary:#2563eb;
}

/* ================= PAGE ================= */
.page-title{
    font-size:22px;
    font-weight:700;
    color:var(--dark);
    margin-bottom:26px;
}

/* ================= CARD ================= */
.review-card{
    background:linear-gradient(180deg,#ffffff,#f9fafb);
    border-radius:20px;
    border:1px solid var(--line);
    padding:20px;
    height:100%;
    transition:.3s ease;
    box-shadow:0 14px 30px rgba(15,23,42,.08);
    display:flex;
    gap:16px;
}

.review-card:hover{
    transform:translateY(-6px);
    box-shadow:0 30px 60px rgba(15,23,42,.14);
}

/* ================= COVER ================= */
.book-cover{
    width:90px;
    height:130px;
    border-radius:14px;
    object-fit:cover;
    background:#e5e7eb;
    box-shadow:0 10px 24px rgba(0,0,0,.18);
    flex-shrink:0;
}

/* ================= CONTENT ================= */
.review-content{
    display:flex;
    flex-direction:column;
    flex:1;
}

.book-title{
    font-weight:700;
    font-size:15px;
    color:var(--dark);
    line-height:1.3;
}

.user-name{
    font-size:14px;
    font-weight:600;
    color:#1f2937;
    margin-top:6px;
}

.user-email{
    font-size:12px;
    color:var(--muted);
}

/* ================= RATING ================= */
.rating{
    margin:6px 0 8px;
}

.star{
    color:#facc15;
    font-size:14px;
}

.no-star{
    color:#e5e7eb;
    font-size:14px;
}

/* ================= COMMENT ================= */
.comment-box{
    margin-top:auto;
    background:#f1f5f9;
    border-radius:14px;
    padding:14px 16px;
    font-size:14px;
    color:#334155;
    font-style:italic;
    line-height:1.5;
}

/* ================= EMPTY ================= */
.empty-box{
    text-align:center;
    color:var(--muted);
    padding:50px 0;
    font-size:14px;
}

/* ================= MOBILE ================= */
@media(max-width:576px){
    .review-card{
        flex-direction:column;
        align-items:center;
        text-align:center;
    }

    .review-content{
        align-items:center;
    }

    .comment-box{
        text-align:left;
    }
}
</style>

<div class="container my-4">

    <div class="page-title">Ulasan Member</div>

    @if($ulasan->isEmpty())
        <div class="empty-box">
            Belum ada ulasan dari member.
        </div>
    @endif

    <div class="row g-4">
        @foreach($ulasan as $item)
        <div class="col-md-6 col-xl-4">

            <div class="review-card">

                <!-- COVER -->
                <img
                    src="{{ $item->buku->gambar
                        ? asset('gambar_buku/'.$item->buku->gambar)
                        : 'https://via.placeholder.com/200x300?text=No+Cover' }}"
                    class="book-cover"
                    alt="{{ $item->buku->judul }}"
                >

                <!-- CONTENT -->
                <div class="review-content">

                    <div class="book-title">
                        {{ $item->buku->judul }}
                    </div>

                    <div class="user-name">
                        {{ $item->user->name }}
                    </div>

                    <div class="user-email">
                        {{ $item->user->email }}
                    </div>

                    {{-- RATING (AMAN JIKA NULL) --}}
                    @if(isset($item->rating))
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $item->rating ? 'star' : 'no-star' }}">★</span>
                            @endfor
                        </div>
                    @endif

                    <div class="comment-box">
                        “{{ $item->komentar }}”
                    </div>

                </div>

            </div>

        </div>
        @endforeach
    </div>

</div>

@endsection
