<!-- Topbar -->

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow w-100">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Jam -->
  <div id="clock" class="container d-flex mr-auto mt-auto mb-auto text-dark h5 font-weight-bold">
  </div>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->nama }}</span>
        @php
        $nama_pengguna = auth()->user()->nama;
        $data_guru = DB::table('gurus')
        ->join('users', 'gurus.nama', '=', 'users.nama')
        ->where('users.nama', $nama_pengguna)
        ->select('gurus.foto')
        ->first();
        @endphp

        @if ($data_guru)
        <img class="img-profile rounded-circle" src="{{ asset('/storage/' . $data_guru->foto) }}">
        @else
        <img class="img-profile rounded-circle" src="{{ asset('admin/img/undraw_profile.svg') }}">
        @endif
      </a>

      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{ asset('profile') }}">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <div class="dropdown-divider"></div>
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="dropdown-item bg-danger text-white"
            onclick="return confirm('Apakah Anda yakin?')">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </button>
        </form>

      </div>

    </li>



  </ul>

</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script>
  moment.locale('id');
function updateClock() {
    const now = moment();
    const dateString = now.format('DD MMMM YYYY'); 
    const timeString = now.format('HH:mm:ss');
   
    document.getElementById('clock').textContent = dateString + ' | ' + timeString;
  }

  updateClock();

  setInterval(updateClock, 1000);
</script>