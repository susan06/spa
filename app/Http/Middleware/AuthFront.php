<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthFront
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
         if ( ! Auth::guard($guard)->check() ) {
            
            $message = 'Debe estar logueado para poder seguir con la acción';
            
            if ( $request->ajax() ) {

                $request->session()->flash('success', $message);

                return response()->json([
                    'success' => false,
                    'login' => route('login')
                ]);
            }

            return redirect()->route('login')->withSuccess($message);

        }

        return $next($request);
        
    }
}
