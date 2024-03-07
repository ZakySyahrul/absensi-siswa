@extends('layouts.master')

@section('title')
Presensi
@endsection

@section('content')

<div class="row">
    <!-- Card-->

    @foreach ($kelas as $data)

    <div class="col-xl-3 col-md-6 mb-4">
        <a href="/presensi_siswa/{{ $data->id }}/check">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Kelas Dan Jurusan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $data->nama_kelas }}</div>
                            <div class="text-xs mb-0 font-weight-bold text-gray-800">Walas: {{ $data->guru->nama }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    @endforeach

    @if(count($kelas) == 0)
    <div class="col-12">
        <div class="alert alert-warning" role="alert">
            Belum ada kelas yang tersedia saat ini.
        </div>
    </div>
    @endif

</div>

@endsection
