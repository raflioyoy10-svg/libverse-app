@extends('member.layout2')

@section('content')

<style>
:root{
    --dark:#0f172a;
    --muted:#64748b;
    --border:#e5e7eb;
    --soft:#f8fafc;
}

/* ================= WRAPPER ================= */
.notify-wrapper{
    max-width:720px;
    margin:0 auto;
}

/* ================= TITLE ================= */
.notify-title{
    font-size:26px;
    font-weight:800;
    color:var(--dark);
    margin-bottom:24px;
}

/* ================= CARD ================= */
.notify-card{
    background:#fff;
    padding:16px 20px;
    border-radius:16px;
    margin-bottom:14px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    transition:.25s;
}

.notify-card:hover{
    transform:translateY(-2px);
    box-shadow:0 14px 32px rgba(0,0,0,.12);
}

/* ================= TEXT ================= */
.notify-text{
    font-size:14px;
    color:var(--dark);
    line-height:1.6;
}

.notify-time{
    font-size:12px;
    color:var(--muted);
    margin-top:8px;
}

/* ================= EMPTY ================= */
.notify-empty{
    text-align:center;
    padding:40px;
    background:var(--soft);
    border-radius:16px;
    color:var(--muted);
}
</style>

@php
    \App\Models\Notifikasi::where('user_id', Auth::id())
        ->where('dibaca', 0)
        ->update(['dibaca' => 1]);
@endphp

<div class="notify-wrapper">

    <div class="notify-title">🔔 Notifikasi</div>

    @forelse($notifikasi as $n)
        <div class="notify-card">
            <div class="notify-text">
                {{ $n->pesan }}
            </div>
            <div class="notify-time">
                {{ $n->created_at->diffForHumans() }}
            </div>
        </div>
    @empty
        <div class="notify-empty">
            Tidak ada notifikasi
        </div>
    @endforelse

</div>

@endsection
