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

    // Check user type
    switch ($user->type) {
        case "Ship-Mark":
            // Check user role
            if ($user->role == 0) {
                return redirect()->route('Ship-Mark.admin.dashboard');
            } elseif ($user->role == 1) {
                return redirect()->route('Ship-Mark.pegawai.dashboard');
            }
            break;
    
        case "Form-Check":
            if ($user->role == 0 ) {
                return redirect()->route('Form-Check.admin.dashboard');
            }
            elseif($user->role == 1){
                return view('welcome');
            }
            break;
        case "else":
            // Both types have the same logic, so combine them
            if ($user->role == 0 ) {
                return view('welcome');
            }
            elseif($user->role == 1){
                return view('welcome');
            }
            break;
    
        default:
        return redirect()->route('login')->with('error', 'Type of user is not found');
    }
    
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
}
