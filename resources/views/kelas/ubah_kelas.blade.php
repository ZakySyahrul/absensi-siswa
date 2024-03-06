<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Kelas</title>
</head>
<body>
    <form action="/kelas/{{ $kelas->id }}" method="post">
        @method('PUT')
      @csrf
        <label for="">Nama Kelas: </label><input type="text" name="nama_kelas" value="{{ $kelas->nama_kelas }}">
        <br><br>
        <select name="guru_id" id="guru_id">
          @foreach ($guru as $data)
              <option value="{{ $data->id }}">{{ $data->nama }}</option>
          @endforeach
        </select>
        <br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>