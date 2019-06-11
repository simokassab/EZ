<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      switch ($guard) {
        case 'admin':
        if (Auth::guard($guard)->check()) {
            return redirect()->route('admin.dashboard');
        }
          break;

          case 'brokers':
          if (Auth::guard($guard)->check()) {
              return redirect()->route('brokers.dashboard');
          }
            break;

        case 'supervisor':
          if (Auth::guard($guard)->check()) {
              return redirect()->route('supervisor.dashboard');
          }
            break;
        
        case 'corporate':
          if (Auth::guard($guard)->check()) {
              return redirect()->route('corporates.dashboard');
          }
            break;

        default:
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }
          break;
      }
        //if (Auth::guard($guard)->check()) {
        //    return redirect('/home');
      //  }

        return $next($request);
    }
}
