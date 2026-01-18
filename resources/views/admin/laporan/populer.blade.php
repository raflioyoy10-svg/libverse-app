@extends('admin.layout')

@section('content')

<style>
:root{
    --bg:#f8fafc;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#64748b;
    --line:#e5e7eb;
    --primary:#2563eb;
}

/* ================= PAGE ================= */
.container-fluid{
    max-width:1400px;
    padding-left:24px;
    padding-right:24px;
}

/* ================= HEADER ================= */
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    margin-bottom:28px;
    flex-wrap:wrap;
    gap:10px;
}

.page-title{
    font-size:22px;
    font-weight:700;
    color:var(--text);
    letter-spacing:.3px;
}

.chart-subtitle{
    font-size:14px;
    color:var(--muted);
    margin-top:4px;
}

/* ================= CARD ================= */
.card-modern{
    background:linear-gradient(180deg,#ffffff,#f9fafb);
    border-radius:22px;
    border:1px solid var(--line);
    padding:26px 28px 30px;
    box-shadow:
        0 20px 45px rgba(15,23,42,.08),
        inset 0 1px 0 rgba(255,255,255,.6);
    transition:.3s ease;
}

.card-modern:hover{
    box-shadow:
        0 30px 70px rgba(15,23,42,.12),
        inset 0 1px 0 rgba(255,255,255,.6);
}

/* ================= CHART ================= */
.chart-wrapper{
    position:relative;
    height:380px;
}

/* ================= MOBILE ================= */
@media(max-width:768px){
    .page-title{
        font-size:20px;
    }

    .chart-wrapper{
        height:300px;
    }

    .card-modern{
        padding:22px 20px;
    }
}
</style>

<div class="container-fluid my-4">

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <div class="page-title">Buku Terpopuler</div>
            <div class="chart-subtitle">
                Statistik buku berdasarkan jumlah peminjaman
            </div>
        </div>
    </div>

    <!-- CARD -->
    <div class="card-modern">
        <div class="chart-wrapper">
            <canvas id="chartBuku"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartBuku');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($populer->pluck('buku.judul')) !!},
        datasets: [{
            label: 'Jumlah Peminjaman',
            data: {!! json_encode($populer->pluck('total')) !!},
            backgroundColor: 'rgba(37,99,235,.85)',
            hoverBackgroundColor: 'rgba(37,99,235,1)',
            borderRadius: 12,
            barThickness: 42
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation:{
            duration:900,
            easing:'easeOutQuart'
        },
        plugins:{
            legend:{
                display:false
            },
            tooltip:{
                backgroundColor:'#0f172a',
                titleColor:'#ffffff',
                bodyColor:'#e5e7eb',
                padding:14,
                cornerRadius:12,
                displayColors:false
            }
        },
        scales: {
            x: {
                grid: { display:false },
                ticks:{
                    color:'#64748b',
                    font:{ size:12 }
                }
            },
            y: {
                beginAtZero:true,
                grid:{
                    color:'rgba(15,23,42,.06)'
                },
                ticks:{
                    color:'#64748b',
                    font:{ size:12 }
                }
            }
        }
    }
});
</script>

@endsection
