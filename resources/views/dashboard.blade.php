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
                <h6 class="m-0 font-weight-bold text-primary">Presentase Kehadiran Siswa</h6>
            </div>
            <div class="card-body">
                <canvas id="presentaseChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Presentase Kehadiran Siswa</h6>
            </div>
            <div class="card-body">
                <canvas id="bar"></canvas>
            </div>
        </div>
    </div>

</div>
<!-- Menambahkan chart untuk presentase kehadiran -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
            const data = {
                labels: ['Hadir', 'Sakit', 'Izin', 'Alpa'],
                datasets: [{
                    label: 'Hadir',
                    data: [{{ $totalHadir }}, 0, 0, 0],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }, {
                    label: 'Sakit',
                    data: [0, {{ $totalSakit }}, 0, 0],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                }, {
                    label: 'Izin',
                    data: [0, 0, {{ $totalIzin }}, 0],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }, {
                    label: 'Alpa',
                    data: [0, 0, 0, {{ $totalAlpa }}],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Chart.js Line Chart'
                        }
                    },
                    animation: { // Menambahkan animasi
                        duration: 8000, // durasi animasi dalam milidetik
                        easing: 'easeOutElastic' // jenis easing animasi
                    }
                },
            };

            const ctx = document.getElementById('presentaseChart').getContext('2d');
            const myChart = new Chart(ctx, config);
        });
</script>

<script>
    // Data untuk chart
        const data = {
            labels: ['Hadir', 'Sakit', 'Izin', 'Alpa'],
            datasets: [{
                label: 'Hadir',
                data: [{{ $totalHadir }}, 0, 0, 0]
            }, {
                label: 'Sakit',
                data: [0, {{ $totalSakit }}, 0, 0]
            }, {
                label: 'Izin',
                data: [0, 0, {{ $totalIzin }}, 0]
            }, {
                label: 'Alpa',
                data: [0, 0, 0, {{ $totalAlpa }}]
            }]
        };

        // Pengaturan chart
        const config = {
            type: 'bar',
            data: data,
            options: {
                animation: { // Menambahkan animasi
                    duration: 3000, // durasi animasi dalam milidetik
                    easing: 'easeInBounce' // jenis easing animasi
                }
            }
        };


        // Membuat chart baru
        var myChart = new Chart(
            document.getElementById('bar'),
            config
        );
</script>
@endsection