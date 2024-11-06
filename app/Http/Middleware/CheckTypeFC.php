<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTypeFC
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna adalah pegawai (role = 1)
        if (Auth::check()) {
            $user = Auth::user();
            $type = json_decode($user->type, true); // Decode the JSON type field

            if (is_array($type) && (in_array("FC", $type) || in_array("all", $type))) {
                return $next($request);
            }
            return response()->view('errors.custom', ['message' => 'Youre not should be in this section'], 403);
        }
        return redirect('/');; // Ganti dengan kode status atau rute yang sesuai
    }
}
