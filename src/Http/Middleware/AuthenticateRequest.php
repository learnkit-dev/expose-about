<?php

namespace LearnKit\ExposeAbout\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateRequest
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        abort_unless($token === config('expose-about.token'), 403);

        if (filled($ips = config('expose-about.ip_whitelist'))) {
            ray($request->ip(), $ips);

            abort_unless(in_array($request->ip(), $ips), 403);
        }

        return $next($request);
    }
}