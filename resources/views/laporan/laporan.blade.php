@extends('layouts.master')

@section('title')
Laporan
@endsection

@section('content')
<div class="container">
  <div class="row mb-3">
    <div class="col-md-6">
      <form method="POST" action="{{ route('filter.laporan') }}" class="mb-3">
        @csrf
        <div class="row g-3">
          <div class="col-md-6">
            <label for="start_date" class="form-label">Tanggal Awal:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="end_date" class="form-label">Tanggal Akhir:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label for="kelas" class="form-label">Pilih Kelas:</label>
            <select name="kelas" id="kelas" class="form-control">
              <option value="">Pilih Kelas</option>
              @foreach($kelas as $data)
              <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary w-100 mt-3">Filter</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Materi</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($presensi_siswa as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->siswa->nama_lengkap }}</td>
              <td>{{ $data->siswa->kelas->nama_kelas }}</td>
              <td>{{ $data['status_presensi'] }}</td>
              <td>{{ $data['keterangan'] }}</td>
              <td>{{ $data->presensi->materi }}</td>
              <td>{{ $data['created_at'] }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Materi</th>
              <th>Tanggal</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection