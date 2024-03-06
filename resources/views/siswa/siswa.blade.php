@extends('layouts.master')

@section('title')
    Siswa
@endsection


@section('content')
    @foreach (['nisn', 'nama_lengkap', 'telepon'] as $field)
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
            <h6 class="m-0 font-weight-bold text-dark">Daftar Siswa</h6>
        </div>
        <div class="card-body">
            <div class="d-md-flex justify-content-between align-items-center mb-3">
                <div>
                    @can('admin')
                        <button type="button" class="btn btn-primary mb-3 mb-md-0 mr-md-3" data-toggle="modal"
                            data-target="#tambah">
                            <i class="fas fa-plus-circle me-2"></i> Tambah Data
                        </button>
                    @endcan
                </div>
                <div>
                    @can('admin')
                        <form action="/siswa/import" method="POST" enctype="multipart/form-data"
                            class="d-flex align-items-center">
                            @csrf
                            <div class="input-group">
                                <input type="file" class="form-control mr-2" name="import" id="importFile"
                                    accept="file/xlsx" required>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    @endcan
                </div>

            </div>




            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th data-orderable="false">NISN</th>
                            <th>Kelas Dan Jurusan</th>
                            <th>Jenis Kelamin</th>
                            <th data-orderable="false">Telpon</th>
                            @can('admin')
                                <th data-orderable="false">Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>NISN</th>
                            <th>Kelas Dan Jurusan</th>
                            <th>Jenis Kelamin</th>
                            <th>Telpon</th>
                            @can('admin')
                                <th>Action</th>
                            @endcan
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($siswa as $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $siswa['nama_lengkap'] }}</td>
                                <td>{{ $siswa['nisn'] }}</td>
                                <td>{{ $siswa->kelas->nama_kelas }}</td>
                                <td>{{ $siswa['jenis_kelamin'] }}</td>
                                <td>{{ $siswa['telepon'] }}</td>
                                @can('admin')
                                    <td>
                                        <div class="btn-group" style="font-size: 12px;">
                                            <a href="" class="btn btn-success btn-sm edit-button mr-1"
                                                data-toggle="modal" data-target="#edit-{{ $siswa->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="/siswa/{{ $siswa['id'] }}" method="post" style="display: inline;">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin?')">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endcan

                            </tr>
                            {{-- Modal Edit --}}
                            <div class="modal fade" id="edit-{{ $siswa->id }}" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header  text-dark">
                                            <h3 class="modal-title font-weight-bold" id="editLabel">Edit Data Siswa</h3>
                                            <button type="button" class="close text-dark" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/siswa/{{ $siswa->id }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nisn">NISN:</label>
                                                    <input type="number" class="form-control" id="nisn" name="nisn"
                                                        value="{{ $siswa->nisn }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_lengkap">Nama Lengkap:</label>
                                                    <input type="text" class="form-control" id="nama_lengkap"
                                                        name="nama_lengkap" value="{{ $siswa->nama_lengkap }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                                        required>
                                                        <option value="" disabled selected hidden>Pilih Jenis Kelamin
                                                        </option>
                                                        <option value="L"
                                                            {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                            Laki-Laki</option>
                                                        <option value="P"
                                                            {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelas_id">Kelas:</label>
                                                    <select class="form-control" id="kelas_id" name="kelas_id">
                                                        @foreach ($kelas as $data)
                                                            <option value="{{ $data->id }}"
                                                                {{ $siswa->kelas_id == $data->id ? 'selected' : '' }}>
                                                                {{ $data->nama_kelas }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telepon">Telepon:</label>
                                                    <input type="tel" class="form-control" id="telepon"
                                                        name="telepon" value="{{ $siswa->telepon }}">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-dark">
                    <h3 class="modal-title" id="staticBackdropLabel" style="font-weight: bold;">Tambah Data Siswa</h3>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/siswa" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="nisn" name="nisn" required
                                placeholder="NISN">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required
                                placeholder="Nama Lengkap Siswa">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="kelas_id" name="kelas_id" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="tel" class="form-control" id="telepon" name="telepon"
                                placeholder="Telepon" maxlength="12" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
