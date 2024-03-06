@extends('layouts.master')

@section('title')
Guru
@endsection

@section('content')
@foreach (['nama', 'nip', 'telepon'] as $field)
    @if ($errors->has($field))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first($field) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endforeach




<!-- Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Daftar Guru</h6>
    </div>
    <div class="card-body">
        @can('admin')
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah">
            <i class="fas fa-plus-circle me-2"></i> Tambah Data
        </button>
        @endcan

        <div class="table-responsive">
            <table class="table table-striped table-bordered nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th data-orderable="false">NIP</th>
                        <th>Jenis Kelamin</th>
                        <th data-orderable="false">Telepon</th>
                        <th data-orderable="false">Foto</th>
                        @can('admin')
                        <th data-orderable="false">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>NIP</th>
                        <th>Jenis Kelamin</th>
                        <th>Telepon</th>
                        <th>Foto</th>
                        @can('admin')
                        <th>Action</th>
                        @endcan
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($guru as $guru)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $guru['nama'] }}</td>
                        <td>{{ $guru['nip'] }}</td>
                        <td>{{ $guru['jenis_kelamin'] }}</td>
                        <td>{{ $guru['telepon'] }}</td>
                        <td>
                            <img src="/storage/{{ $guru['foto'] }}" width="50px" height="50px" alt="">
                        </td>
                        @can('admin')
                        <td>
                            <a href="" class="btn btn-success btn-sm edit-button" data-toggle="modal"
                                data-target="#edit-{{ $guru->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="/guru/{{ $guru['id'] }}" method="post" style="display: inline;">
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
                    <div class="modal fade" id="edit-{{ $guru->id }}" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-dark">
                                    <h3 class="modal-title font-weight-bold" id="editLabel">Edit Data Guru</h3>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/guru/{{ $guru->id }}" method="post" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap:</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                placeholder="Nama Lengkap" required value="{{ $guru->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="number" name="nip" class="form-control"
                                                value="{{ $guru->nip }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                                required>
                                                <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
                                                <option value="L" {{ ($guru->jenis_kelamin == 'L') ? 'selected' : ''
                                                    }}>Laki-Laki</option>
                                                <option value="P" {{ ($guru->jenis_kelamin == 'P') ? 'selected' : ''
                                                    }}>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="telepon">Telepon:</label>
                                            <input type="tel" class="form-control" id="telepon" name="telepon"
                                                value="{{ $guru->telepon }}">
                                        </div>
                                        <div class="form-group">
                                            @if ($guru->foto)
                                            <img src="/storage/{{ $guru['foto'] }}" class="img-thumbnail" alt="Foto"
                                                style="width: 100px; height:100px;">
                                            @endif
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" class="file-input" id="foto" name="foto"
                                                        accept="image/*">
                                                </div>
                                            </div>
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
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-dark">
                <h3 class="modal-title" id="tambahdataLabel" style="font-weight: bold;">Tambah Data Guru</h3>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/guru" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap"
                            required>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" id="nama" name="nip" placeholder="NIP" required>
                    </div>

                    <div class="form-group">
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="Telepon"
                            maxlength="12" required>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="file-input" id="foto" name="foto" accept="image/*">
                        </div>
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