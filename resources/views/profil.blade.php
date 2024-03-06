@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 text-center">
              @php
              $nama_pengguna = auth()->user()->nama;
              $data_guru = DB::table('gurus')
              ->join('users', 'users.nama', '=', 'gurus.nama')
              ->where('users.nama', $nama_pengguna)
              ->select('gurus.foto', 'gurus.telepon', 'gurus.nip')
              ->first();

              $foto = $data_guru && $data_guru->foto ? asset('/storage/' . $data_guru->foto) :
              asset('admin/img/undraw_profile.svg');
              @endphp

              <img class="img-fluid rounded-circle profile-image" src="{{ $foto }}" alt="Profile Picture">
              <h5 class="mt-3">{{ auth()->user()->nama }}</h5>
            </div>
            <div class="col-md-8">
              <div class="profile-details">
                <h3 class="mb-3">Profile Details</h3>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Username:</strong> {{ auth()->user()->username }}</li>
                  <li class="list-group-item"><strong>NIP:</strong> {{ $data_guru && $data_guru->nip != 0 ?
                    $data_guru->nip : 'N/A' }}</li>

                  <li class="list-group-item"><strong>Telpon:</strong> {{ $data_guru ? $data_guru->telepon :
                    '+1234567890' }}</li>
                  <li class="list-group-item"><strong>Terdaftar:</strong> {{ auth()->user()->created_at->format('d M Y')
                    }}</li>
                  <li class="list-group-item"><strong>Mapel:</strong>
                    <ul>
                      @php
                      $mapels = DB::table('mapels')
                      ->join('users', 'users.id', '=', 'mapels.guru_mapel')
                      ->where('users.nama', $nama_pengguna)
                      ->pluck('nama_mapel')
                      ->toArray();
                      @endphp
                      @forelse($mapels as $mapel)
                      <li>{{ $mapel }}</li>
                      @empty
                      <li>Tidak ada mapel</li>
                      @endforelse
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection