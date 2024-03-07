@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<h3>Selamat Datang, <span style="font-weight: bold;" class="text-dark">{{ auth()->user()->nama
        }}</span></h3>

<div class="row">
    <!-- Card data siswa -->
    <div class="col-xl-3 col-md-6 mt-2">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Siswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSiswa }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card data guru -->
    <div class="col-xl-3 col-md-6 mt-2">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Guru</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalGuru }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- card data mapel --}}
    <div class="col-xl-3 col-md-6 mt-2">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Mapel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMapel }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- card data kelas --}}
    <div class="col-xl-3 col-md-6 mt-2">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Kelas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKelas }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-school fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-6 mt-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Presentase Kehadiran Siswa (Pie Chart)</h6>
            </div>
            <div class="card-body">
                <canvas id="presentaseChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Presentase Kehadiran Siswa (Bar Chart)</h6>
            </div>
            <div class="card-body">
                <canvas id="barChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Menambahkan chart untuk presentase kehadiran -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var presentaseData = {
        labels: ["Hadir", "Sakit", "Izin", "Alpa"],
        datasets: [{
            data: [{{ $totalHadir }}, {{ $totalSakit }}, {{ $totalIzin }}, {{ $totalAlpa }}],
            backgroundColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    };

    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: true,
            position: 'right'
        }
    };

    var ctx = document.getElementById('presentaseChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: presentaseData,
        options: chartOptions
    });
</script>

<script>
    // Data kehadiran siswa
        var presentaseData = {
            labels: ["Hadir", "Sakit", "Izin", "Alpa"],
            datasets: [{
                label: "Presentase Kehadiran Siswa",
                data: [{{ $totalHadir }}, {{ $totalSakit }}, {{ $totalIzin }}, {{ $totalAlpa }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        var chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'bottom'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Presentase (%)'
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Kategori'
                    }
                }]
            }
        };

        // Inisialisasi grafik
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: presentaseData,
            options: chartOptions
        });
</script>

@endsection