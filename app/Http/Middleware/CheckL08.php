<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckL08
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user's type JSON field contains "PList" or "all"
            $user = Auth::user();
            $type = json_decode($user->type, true); // Decode the JSON type field

            if (is_array($type) && (in_array("L8", $type) || in_array("all", $type))) {
                return $next($request);
            }

            return response()->view('errors.custom', ['message' => 'You are not authorized to access this section'], 403);
        }

        return redirect('/'); // Redirect to home if the user is not authenticated
    }
}
