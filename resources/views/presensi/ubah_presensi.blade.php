<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Presensi</title>
</head>
<body>
    <form action="/presensi/{{ $presensi->id }}" method="post">
        @method('PUT')
      @csrf
        <label for="">Kode Presensi: </label><input type="text" name="kode_presensi" value="{{ $presensi->kode_presensi }}">
        <br><br>
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
        </select> 
        <br><br>
        <label for="">Materi: </label><input type="text" name="materi" value="{{ $presensi->materi}}">
        <button type="submit">Simpan</button>
    </form>
</body>
</html>