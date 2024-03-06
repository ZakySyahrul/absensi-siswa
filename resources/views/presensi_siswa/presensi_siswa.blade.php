@extends('layouts.master')

@section('title')
PresensiSiswa
@endsection

@section('content')
<button type="button" class="btn btn-primary mb-3" onclick="window.location.href='/presensi'">
    <i class="fas fa-arrow-left me-2"></i> Kembali
</button>

<form id="presensiForm" action="/presensi_siswa/{{ $kelas->id }}/check" method="POST" onsubmit="return confirmSubmit()">
    @csrf
    <div class="row">
        <!-- Cards for Nama Siswa -->
        @foreach ($siswa as $data)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-3">
                <div class="card-body">
                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-2">
                        Data Siswa
                    </div>
                    <input type="hidden" name="siswa_id[]" value="{{ $data->id }}">
                    <div class="mb-2">
                        <span class="font-weight-bold text-gray-800">NAMA:</span> {{ $data->nama_lengkap }}
                    </div>
                    <div class="mb-2">
                        <span class="font-weight-bold text-gray-800">NISN:</span> {{ $data->nisn }}
                    </div>
                    <div class="mb-2">
                        <span class="font-weight-bold text-gray-800">TELPON:</span> {{ $data->telepon }}
                    </div>
                    <div class="text-center mb-3">
                        <div class="btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary btn-sm">
                                <input type="radio" name="status_presensi{{ $data->id }}" value="Hadir"
                                    autocomplete="off" required>
                                <i class="fas fa-check-circle"></i> Hadir
                            </label>
                            <label class="btn btn-outline-info btn-sm">
                                <input type="radio" name="status_presensi{{ $data->id }}" value="Izin"
                                    autocomplete="off" required>
                                <i class="fas fa-info-circle"></i> Izin
                            </label>
                            <label class="btn btn-outline-warning btn-sm">
                                <input type="radio" name="status_presensi{{ $data->id }}" value="Sakit"
                                    autocomplete="off" required>
                                <i class="fas fa-heartbeat"></i> Sakit
                            </label>
                            <label class="btn btn-outline-danger btn-sm">
                                <input type="radio" name="status_presensi{{ $data->id }}" value="Alpa"
                                    autocomplete="off" required>
                                <i class="fas fa-times-circle"></i> Alpa
                            </label>
                        </div>
                    </div>


                    <div class="mt-3">
                        <input class="form-control" type="text" id="keterangan_{{ $data->id }}"
                            name="keterangan{{ $data->id }}" placeholder="Keterangan">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="form-row align-items-center mt-3 mb-3">
        <div class="col-auto">
            <label for="materi" class="mb-0">Materi:</label>
        </div>
        <div class="col">
            <input type="text" class="form-control w-100" id="materi" name="materi" required>
        </div>
        <input type="hidden" name="guru_id" value="{{ auth()->user()->id }}" id="">
        <input type="hidden" name="mapel_id" value="{{ auth()->user()->mapel->id }}" id="">
        <input type="hidden" name="kelas_id" value="{{ $kelas->id }}" id="">

    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">Kirim</button>
    </div>

</form>
<script>
    function confirmSubmit() {
        // Confirm submission with user using SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin ingin mengirim data?',
            text: "Jika Sudah Terkirim Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Kirim!',
            cancelButtonText: 'Tidak, Batalkan!',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Terkirim!',
                    'Data Absensi Berhasil Terkirim!',
                    'success'
                )
                document.getElementById('presensiForm').submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Dibatalkan!',
                    'Data Absensi Batal Terkirim!',
                    'error'
                )
            }
        });
        return false; // Prevent form submission here
    }
</script>
@endsection