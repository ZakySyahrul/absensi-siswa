<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Presensi</title>
</head>
<body>
    <form action="/presensi_siswa/{{ $presensi_siswa->id }}" method="post">
        @method('PUT')
      @csrf
      <select name="presensi_id" id="presensi_id">
        @foreach ($presensi as $data)
            <option value="{{ $data->id }}">{{ $data->id }}</option>
        @endforeach
      </select> 
        <br><br>
      <select name="siswa_id" id="siswa_id">
          @foreach ($siswa as $data)
              <option value="{{ $data->id }}">{{ $data->nama_lengkap }}</option>
          @endforeach
      </select> 
        <br><br>
        <select id="status_presensi" name="status_presensi">
          <option value="Hadir">HADIR</option>
          <option value="Sakit">SAKIT</option>
          <option value="Izin">IZIN</option>
          <option value="Alpa"></option>
      </select>
        <br><br>
        <label for="">Keterangan: </label>
        <input type="text" name="keterangan" value="{{ $presensi_siswa->keterangan }}">      
          <br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>