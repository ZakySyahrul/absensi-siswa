setInterval(function() {
  var lastSeen = new Date(document.querySelector('.status-container').dataset.lastSeenAt);
  var now = new Date();
  var diff = Math.floor((now - lastSeen) / 1000); // menghitung perbedaan waktu dalam detik
  var minutes = Math.floor(diff / 60); // menghitung menit
  var seconds = diff % 60; // menghitung detik

  document.getElementById('onlineTime{{$loop->iteration}}').innerHTML = minutes + ' menit ' + seconds + ' detik';
}, 1000); // perbarui setiap detik
