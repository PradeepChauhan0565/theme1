<?php

namespace App\Http\Middleware;

use App\Models\RoleUrl;
use App\Models\url;
use App\Models\User;
use App\Models\UserUrl;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);

        if (Auth::check() && Auth::user()->id == 1) {
            return $next($request);
        } else {
            if ($request->is('shop/*')  || $request->is('/') || $request->is('login') || $request->is('register') || $request->is('logout')) {

                return  $next($request);
            } elseif (Auth::check()) {
                if (str_contains($request->path(), 'livewire/message')) {
                    return $next($request);
                } else {
                    $urls = [];
                    $roles = User::find(Auth::user()->id)->roles->pluck('id');
                    $url_ids = RoleUrl::whereIn('role_id', $roles)->pluck('url_id');
                    $urls = url::whereIn('id', $url_ids)->orderBy('order_by', 'asc')->get()->pluck('url')->toArray();
                    $url = $request->path();
                    if (in_array($url, $urls)) {
                        return $next($request);
                    }
                    return  abort(403, 'Unauthorized access.');
                }
            }
        }
    }
}
