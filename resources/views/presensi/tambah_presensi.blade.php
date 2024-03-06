<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Presensi</title>
</head>
<body>
    <form action="/presensi" method="post">
      @csrf
      <select name="guru_id" id="guru_id">
        @foreach ($guru as $data)
            <option value="{{ $data->id }}">{{ $data->nama }}</option>
        @endforeach
      </select> 
        <br><br>
        <select name="mapel_id" id="mapel_id">
          @foreach ($mapel as $data)
              <option value="{{ $data->id }}">{{ $data->nama_mapel }}</option>
          @endforeach
        </select> 
        <br><br>
        <select name="kelas_id" id="kelas_id">
            @foreach ($kelas as $data)
                <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
            @endforeach
          </select>        <br><br>
        <label for="">Materi: </label><input type="text" name="materi">
        <br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>

