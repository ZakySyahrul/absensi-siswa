// Import library Pusher
import Pusher from 'pusher-js';

// Inisialisasi Pusher dengan informasi yang sesuai dari .env
const pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  encrypted: true,
});

// Berlangganan ke channel 'admin-channel'
const channel = pusher.subscribe('admin-channel');

// Menangani event 'guru-logged-in'
channel.bind('guru-logged-in', function(data) {
  // Menampilkan notifikasi atau melakukan tindakan yang sesuai
  console.log('Notifikasi: ' + data.message);
});
