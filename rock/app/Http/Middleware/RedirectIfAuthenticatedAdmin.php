<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use DB;

class RedirectIfAuthenticatedAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {

        $get_site_data = DB::select('SELECT site_name FROM `site_setting`');
        $get_site_data = json_decode(json_encode($get_site_data), True);

        $site_name = $get_site_data[0]['site_name'];
        define('site_name', $site_name);

        $uri = $request->path();
        $bypass_uri = array('admin/logout');

        if (!in_array($uri, $bypass_uri)) {

            if ($uri == "admin/login" || $uri == "admin" || $uri == "admin/forgot_password") {

                if (Auth::guard($guard)->check()) {

                    if (Auth::user()->urole != 1) { // User
                        return redirect('/');
                    }
                    return redirect('admin/dashboard');
                }
            } else {
                if (!Auth::guard($guard)->check()) {
                    return redirect('admin');
                }
                if (Auth::user()->urole != 1) { // User
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }

}
