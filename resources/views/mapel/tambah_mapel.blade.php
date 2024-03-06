<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Mapel</title>
</head>
<body>
    <form action="/mapel" method="post">
      @csrf
      <label for="">Nama Mapel: </label><input type="text" name="nama_mapel">
      <br><br>
      <label for="">Nama Guru: </label>
      <select name="guru_mapel" id="guru_mapel">
        @foreach ($guru as $data)
            <option value="{{ $data->id }}">{{ $data->nama }}</option>
        @endforeach
      </select>
      <br><br>
      <button type="submit">Simpan</button>
    </form>
</body>
</html>