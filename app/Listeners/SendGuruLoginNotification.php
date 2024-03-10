<?php

namespace App\Listeners;

use App\Events\GuruLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GuruLoginNotification;
use Pusher\Pusher;
use Illuminate\Support\Facades\Session;


class SendGuruLoginNotification implements ShouldQueue
{
    use InteractsWithQueue;
    public function handle(GuruLoggedIn $event)
    {
        // Mendapatkan instance guru yang berhasil login
        $user = $event->user;

        // Kirim notifikasi ke admin melalui email
        Notification::route('mail', 'syahzaky84@gmail.com')->notify(new GuruLoginNotification($user));

        // Kirim notifikasi real-time ke admin menggunakan Pusher
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $pusher->trigger('admin-channel', 'guru-logged-in', [
            'message' => 'Guru dengan nama ' . $user->nama . ' berhasil login pada jam ' . now()->format('H:i') . '.',
        ]);

        // Menyimpan flash message jika pengguna adalah admin
        if ($user->role === 'Admin') {
            Session::flash('alert', 'Guru dengan nama ' . $user->nama . ' berhasil login pada jam ' . now()->format('H:i') . '.');
        }
    }
}