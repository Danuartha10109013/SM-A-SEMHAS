<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function proses(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    // Mencoba mencari user berdasarkan email
    $user = User::where('email', $request->email)->first();

    // Jika user tidak ditemukan
    if (!$user) {
        return redirect()->back()->with('error', 'Email tidak ditemukan.');
    }

    // Cek status aktif pengguna
    if ($user->active == 2) {
        return redirect()->back()->with('error', 'Akun Anda tidak aktif.');
    }

    // Memeriksa kecocokan password
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Password salah.');
    }

    // Autentikasi berhasil
    Auth::login($user);

    // Cek peran pengguna setelah login berhasil
    if ($user->role == 0) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role == 1) {
        return redirect()->route('pegawai.dashboard');
    }

    // Redirect ke halaman dashboard default jika role tidak dikenali
    return redirect()->route('dashboard')->with('success', 'Login berhasil.');
}


public function logout(Request $request) {
    Auth::logout();
    // Mengarahkan kembali ke halaman login dengan pesan sukses
    return redirect()->route('login')->with('success', 'Kamu berhasil Logout');
}
public function logoutUserById($userId)
{
    // Temukan pengguna dengan ID tertentu
    $user = DB::table('users')->where('id', $userId)->first();

    if ($user) {
        // Menghapus token untuk logout pengguna
        DB::table('users')
            ->where('id', $userId)
            ->update(['remember_token' => null]);

        // Jika Anda menggunakan session-based authentication
        // Hapus sesi pengguna tertentu jika perlu
        // Session::forget('user_' . $userId);

        return redirect()->route('auth.login')->with('success', 'Pengguna dengan ID ' . $userId . ' berhasil Logout');
    }

    return redirect()->route('auth.login')->with('error', 'Pengguna tidak ditemukan');
}
}
