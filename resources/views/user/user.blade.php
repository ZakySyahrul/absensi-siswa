@extends('layouts.master')

@section('title')
User
@endsection


@section('content')

@foreach (['username'] as $field)
@if ($errors->has($field))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ $errors->first($field) }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@endforeach




<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Daftar User</h6>
  </div>
  <div class="card-body">
    <div class="d-md-flex justify-content-between align-items-center mb-3">
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama User</th>
            <th>Username</th>
            <th data-orderable="false">Password</th>
            <Th data-orderable="false">Status</Th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Nama User</th>
            <th>Username</th>
            <th>Password</th>
            <Th>Status</Th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->username }}</td>
            <td nowrap>Password terenkripsi</td>
            <td>
              <div class="status-container">
                @if ($user->is_online)
                <span class="badge badge-success">Online</span>
                <span class="online-time" id="onlineTime{{$loop->iteration}}">
                  @php
                  $days = floor($user->onlineTime / (3600 * 24));
                  $hours = floor(($user->onlineTime % (3600 * 24)) / 3600);
                  $minutes = floor(($user->onlineTime % 3600) / 60);
                  $seconds = $user->onlineTime % 60;
                
                  if ($days > 0) {
                    echo $days . ' hari ' . $hours . ' jam ' . $minutes . ' menit';
                  } elseif ($hours > 0) {
                    echo $hours . ' jam ' . $minutes . ' menit';
                  } else {
                    echo $minutes . ' menit ' . $seconds . ' detik';
                  }
                  @endphp
                </span>
                <script>
                  setInterval(function() {
                    var now = new Date(); // Mengambil waktu sekarang
                    var lastSeen = new Date('{{ $user->last_seen_at }}'); // Mengambil waktu terakhir terlihat
                
                    // Memeriksa apakah waktu terakhir terlihat tersedia dan valid
                    if (lastSeen && !isNaN(lastSeen.getTime())) {
                      var diff = Math.floor((now - lastSeen) / 1000); // menghitung perbedaan waktu dalam detik
                      var minutes = Math.floor(diff / 60); // menghitung menit
                      var seconds = diff % 60; // menghitung detik
                
                      // Memeriksa apakah waktu online telah melewati 24 jam atau tidak
                      if (minutes >= 60 * 24) {
                        // Jika waktu melewati 24 jam, konversi menit menjadi hari, jam, dan menit
                        var days = Math.floor(minutes / (60 * 24));
                        minutes = minutes % (60 * 24);
                        var hours = Math.floor(minutes / 60);
                        minutes = minutes % 60;
                        document.getElementById('onlineTime{{$loop->iteration}}').innerHTML = days + ' hari ' + hours + ' jam ' + minutes + ' menit';
                      } else if (minutes >= 60) {
                        // Jika waktu melewati 1 jam, konversi menit menjadi jam dan menampilkan waktu dalam format jam dan menit
                        var hours = Math.floor(minutes / 60);
                        minutes = minutes % 60;
                        document.getElementById('onlineTime{{$loop->iteration}}').innerHTML = hours + ' jam ' + minutes + ' menit';
                      } else {
                        // Jika waktu belum melewati 1 jam, tampilkan waktu dalam format menit dan detik
                        document.getElementById('onlineTime{{$loop->iteration}}').innerHTML = minutes + ' menit ' + seconds + ' detik';
                      }
                    }
                  }, 1000); // perbarui setiap detik
                
                  // Deteksi apakah perangkat adalah perangkat mobile
                  if (window.matchMedia("(max-width: 768px)").matches) {
                    // Jika iya, tambahkan class mobile pada elemen online-time
                    document.getElementById('onlineTime{{$loop->iteration}}').classList.add('mobile');
                  }
                </script>
                        
                @else
                <span class="badge badge-secondary">Offline</span>
                <span class="offline-time">
                  @if ($user->last_seen_at)
                  {{ \Carbon\Carbon::parse($user->last_seen_at)->diffForHumans() }}
                  @else
                  Belum Pernah Online
                  @endif
                </span>
                @endif
              </div>
            </td>


          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@endsection