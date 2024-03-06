<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Guru</title>
</head>
<body>
    <form action="/guru/{{ $guru->id }}" method="post" enctype="multipart/form-data">
        @method('PUT')
      @csrf
        <label for="">Nama Lengkap: </label><input type="text" name="nama" value="{{ $guru->nama }}">
        <br><br>
        <label for="">Jenis Kelamin: </label>
        <br>
        <input type="radio" name="jenis_kelamin" value="P" {{ ($guru->jenis_kelamin == 'P' ) ? 'checked' : '' }}>Perempuan
        <input type="radio" name="jenis_kelamin" value="L"  {{ ($guru->jenis_kelamin == 'L' ) ? 'checked' : '' }}>Laki-Laki
        <br><br>
        <label for="">Telepon: </label><input type="tel" name="telepon" value="{{ $guru->telepon }}">
        <br><br>
        @if ($guru->foto)
        <img src="/storage/{{ $guru['foto'] }}" width="200px" alt="">
        @endif
        <label for="">Foto: </label><input type="file" name="foto" accept="image/*">
        <br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>