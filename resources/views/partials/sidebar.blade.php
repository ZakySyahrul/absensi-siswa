<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-white accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ asset('dashboard') }}">
    <div class="sidebar-brand-icon">
      <img src="/img/cn.png" alt="" style="width: 65px">
    </div>
    <div class="sidebar-brand-text mx-3 text-dark">ABSENSI SISWA <sup>CN</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active ">
    <a class="nav-link text-dark" href="{{ asset('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt text-dark"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->

  <hr class="sidebar-divider bg-dark">

  <!-- Heading -->
  <div class="sidebar-heading text-dark">
    Interface
  </div>

  @can('admin')
  <!-- Nav Item - Guru -->
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('guru.index') }}">
      <i class="fas fa-fw fa-chalkboard-teacher text-dark"></i>
      <span>Guru</span>
    </a>
  </li>
  @endcan

  @can('kedis')
  <!-- Nav Item - Guru -->
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('guru.index') }}">
      <i class="fas fa-fw fa-chalkboard-teacher text-dark"></i>
      <span>Guru</span>
    </a>
  </li>
  @endcan



  <!-- Nav Item - Siswa -->
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('siswa.index') }}">
      <i class="fas fa-fw fa-user-graduate text-dark"></i>
      <span>Siswa</span>
    </a>
  </li>

  <!-- Nav Item - Kelas -->
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('kelas.index') }}">
      <i class="fas fa-fw  fa-chalkboard text-dark"></i>
      <span>Kelas</span>
    </a>
  </li>

  @can('admin')
  <!-- Nav Item - Mapel -->
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('mapel.index') }}">
      <i class="fas fa-fw fa-book text-dark"></i>
      <span>Mata Pelajaran</span>
    </a>
  </li>
  @endcan


  @can('guru')
  <!-- Nav Item - Absen -->
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('presensi.index') }}">
      <i class="fas fa-fw fa-calendar-check text-dark"></i>
      <span>Absensi</span>
    </a>
  </li>
  @endcan


  <!-- Nav Item - Laporan -->
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('laporan.index') }}">
      <i class="fas fa-fw fa-file text-dark"></i>
      <span>Laporan</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block bg-dark">
  @can('admin')
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('user.index') }}">
      <i class="fas fa-fw fa-user text-dark"></i>
      <span>User</span>
    </a>
  </li>
  @endcan


  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>