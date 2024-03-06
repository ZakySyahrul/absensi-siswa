@extends('layouts.master')

@section('title')
Kelas
@endsection

@section('content')
@foreach (['nama_kelas', 'guru_id'] as $field)
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
        <h6 class="m-0 font-weight-bold text-dark">Daftar Kelas</h6>
    </div>
    <div class="card-body">
        @can('admin')
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus-circle me-2"></i> Tambah Data
        </button>
        @endcan

        <div class="table-responsive">
            <table class="table table-striped table-bordered no wrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kelas</th>
                        <th data-orderable="false">Wali Kelas</th>
                        @can('admin')
                        <th data-orderable="false">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        @can('admin')
                        <th>Action</th>
                        @endcan
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($kelas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        <td>{{ $data->guru->nama }}</td>
                        @can('admin')
                        <td>

                            <a href="" class="btn btn-success btn-sm edit-button" data-toggle="modal"
                                data-target="#edit-{{ $data->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="/kelas/{{ $data['id'] }}" method="post" style="display: inline;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>

                        </td>
                        @endcan

                    </tr>
                    {{-- Modal Edit --}}
                    <div class="modal fade" id="edit-{{ $data->id }}" data-backdrop="static" data-keyboard="false"
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
                                    <form action="/kelas/{{ $data->id }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_kelas" class="text-dark">Nama Kelas:</label>
                                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                                                value="{{ $data->nama_kelas }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="guru_id">Wali Kelas:</label>
                                            <select class="form-control" id="guru_id" name="guru_id">
                                                @foreach ($guru as $guruData)
                                                <option value="{{ $guruData->id }}" {{ $data->guru_id == $guruData->id ?
                                                    'selected' : '' }}>
                                                    {{ $guruData->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


{{-- Modal Tambah --}}
<div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-dark">
                <h3 class="modal-title font-weight-bold" id="tambahdataLabel">Tambah Data Kelas</h3>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/kelas" method="post" class="mx-auto">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kelas" class="text-dark">Nama Kelas:</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas">
                    </div>

                    <div class="form-group">
                        <label for="guru_id" class="text-dark">Wali Kelas:</label>
                        <select class="form-control" id="guru_id" name="guru_id">
                            <option value="" disabled selected>Pilih Wali Kelas</option>
                            @foreach ($guru as $data)
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