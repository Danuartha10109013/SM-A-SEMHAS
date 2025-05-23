<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

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
    
    $email = $request->email;
    // Jika user tidak ditemukan
    if (!$user) {
        return redirect()->back()->with('error', 'Email tidak ditemukan.')->with('email', $email);
    }


    // Cek status aktif pengguna
    if ($user->status == 2) {
        return redirect()->back()->with('error', 'Akun Anda tidak aktif.')->with('email', $email);
    }

    // Memeriksa kecocokan password
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Password salah.')->with('email', $email);
    }

    // Autentikasi berhasil
    Auth::login($user);
    if ($user->role == 0 || $user->role == 5){

        return redirect()->route('welcome')->with('success','Hallo Selamat Datang'.Auth::user()->name);
    }else{

        return redirect()->route('welcome')->with('success','Hallo Selamat Datang'.Auth::user()->name);
    }
    // Check user type

    
    // Redirect to login if role is not recognized or any other case
    return redirect()->route('login')->with('error', 'Login Gagal.');
    
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

public function welcome(){
    return view('welcome');
}
}