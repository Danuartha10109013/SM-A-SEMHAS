<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna adalah Super admin (role = 5)
        if (Auth::check()) {
            if (Auth::user()->role == 5){
                return $next($request);
            }
            return response()->view('errors.custom', ['message' => 'Anda Bukan Super Admin'], 403);
        }
        return redirect('/');
        
        // Jika bukan admin, arahkan ke halaman lain
         // Ganti dengan kode status atau rute yang sesuai
    }
}
