@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')



{{-- <div class="container mt-5 mb-5">
  <form action="/siswa" method="post">
    @csrf
    <h2 class="mb-4">Formulir Siswa</h2>

    <div class="form-group">
      <label for="nisn">NISN:</label>
      <input type="text" class="form-control" id="nisn" name="nisn" required>
    </div>

    <div class="form-group">
      <label for="nama_lengkap">Nama Lengkap:</label>
      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
    </div>

    <div class="form-group">
      <label for="jenis_kelamin">Jenis Kelamin:</label>

      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="jenis_kelamin_p" name="jenis_kelamin" value="P" class="custom-control-input" required>
        <label class="custom-control-label" for="jenis_kelamin_p">Perempuan</label>
      </div>

      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="jenis_kelamin_l" name="jenis_kelamin" value="L" class="custom-control-input" required>
        <label class="custom-control-label" for="jenis_kelamin_l">Laki-Laki</label>
      </div>
    </div>


    <div class="form-group">
      <label for="kelas_id">Kelas:</label>
      <select class="form-control" id="kelas_id" name="kelas_id" required>
        @foreach ($kelas as $data)
        <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="telepon">Telepon:</label>
      <input type="tel" class="form-control" id="telepon" name="telepon" required>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
  </form>
</div> --}}

{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}


@include('layouts.footer')