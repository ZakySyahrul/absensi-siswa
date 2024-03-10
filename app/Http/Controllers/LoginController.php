<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\GuruLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{

    private function calculateOnlineTime($user)
    {
        if ($user->is_online) {
            $lastSeen = Carbon::parse($user->last_seen_at);
            $now = Carbon::now();
            $onlineTime = $lastSeen->diffInSeconds($now);
            return $onlineTime;
        } else {
            return null;
        }
    }

    public function index()
    {
        $users = User::all(); // Mengambil semua data pengguna dari database

        // Menghitung waktu online dan waktu terakhir dilihat untuk setiap pengguna
        foreach ($users as $user) {
            $user->onlineTime = $this->calculateOnlineTime($user);
        }

        return view('user.user', compact('users'));
    }


    public function register()
    {
        $secretToken = request()->query('kode');
        if ($secretToken !== '666546') {
            abort(403, 'Unauthorized');
        }

        $secretToken = '666546';
        $registerLink = route('register') . '?kode=' . $secretToken;

        return view('register', compact('registerLink'));
    }

    public function registration(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required'],
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
            'role' => ['required'],
        ]);

        $validatedData['password'] = bcrypt($request->password);

        User::create($validatedData);

        return redirect('/login');
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();

            $user->is_online = 1;
            $user->last_seen_at = Carbon::now();

            $user->save();

            Event::dispatch(new GuruLoggedIn($user));

            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'LoginFailed' => 'Username atau Password salah',
        ]);
    }

   

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->is_online = 0;
            $user->last_seen_at = Carbon::now();
            $user->save();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/login');
    }
}