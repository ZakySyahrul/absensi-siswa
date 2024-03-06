@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<form action="/siswa/{{ $siswa->id }}" method="post">
    @method('PUT')
    @csrf
    <label for="">NISN: </label><input type="number" name="nisn" value="{{ $siswa->nisn }}">
    <br><br>
    <label for="">Nama Lengkap: </label><input type="text" name="nama_lengkap" value="{{ $siswa->nama_lengkap }}">
    <br><br>
    <label for="">Jenis Kelamin: </label>
    <br>
    <input type="radio" name="jenis_kelamin" value="P" {{ ($siswa->jenis_kelamin == 'P' ) ? 'checked' : '' }}>Perempuan
    <input type="radio" name="jenis_kelamin" value="L" {{ ($siswa->jenis_kelamin == 'L' ) ? 'checked' : '' }}>Laki-Laki
    <br><br>
    <select name="kelas_id" id="kelas_id">
        @foreach ($kelas as $data)
        <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
        @endforeach
    </select>
    <br><br>
    <label for="">Telepon: </label><input type="tel" name="telepon" value="{{ $siswa->telepon }}">
    <br><br>
    <button type="submit">Simpan</button>
</form>
@include('layouts.footer')