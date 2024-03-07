@extends('layouts.master')

@section('title')
Mapel
@endsection

@section('content')

@if ($errors->has('nama_mapel'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $errors->first('nama_mapel') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Daftar Mata Pelajaran</h6>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus-circle me-2"></i> Tambah Data
        </button>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
                        <th data-orderable="false">Guru Mata Pelajaran</th>
                        <th data-orderable="false">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru Mata Pelajaran</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($mapel as $mapel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mapel['nama_mapel'] }}</td>
                        <td>{{ $mapel->guru->nama }}</td>
                        <td>
                            <div class="btn-group " role="group">
                                <a href="" class="btn btn-success btn-sm edit-button mr-1" data-toggle="modal"
                                    data-target="#edit-{{ $mapel->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="/mapel/{{ $mapel['id'] }}" method="post" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    {{-- Modal Edit --}}
                    <div class="modal fade" id="edit-{{ $mapel->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-dark">
                                    <h3 class="modal-title font-weight-bold" id="editLabel">Edit Data Kelas</h3>
                                    <button type="button" class="close text-dark" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/mapel/{{ $mapel->id }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_kelas" class="text-dark">Nama Mapel:</label>
                                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel"
                                                value="{{ $mapel->nama_mapel }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="guru_mapel">Guru Mapel:</label>
                                            <select class="form-control" id="guru_mapel" name="guru_mapel">
                                                @foreach ($user as $data)
                                                <option value="{{ $data->id }}" {{ ($mapel->guru_mapel == $data->id) ?
                                                    'selected'
                                                    : '' }}>
                                                    {{ $data->nama }}
                                                </option>
                                                @endforeach
                                            </select>
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
        </div>
        @endforeach
        </tbody>
        </table>
    </div>
</div>



{{-- Modal Tambah --}}
<div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  text-dark">
                <h3 class="modal-title font-weight-bold" id="tambahdataLabel">Tambah Data Mapel</h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/mapel" method="post" class="mx-auto">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kelas" class="text-dark">Nama Mapel:</label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel">
                    </div>

                    <div class="form-group">
                        <label for="guru_id" class="text-dark">guru Mapel:</label>
                        <select class="form-control" id="guru_mapel" name="guru_mapel" required>
                            <option value="" disabled selected>Pilih Guru Mapel</option>
                            @foreach ($user as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection