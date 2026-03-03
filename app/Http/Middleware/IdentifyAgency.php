<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyAgency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost(); // niaz.lvh.me
        $parts = explode('.', $host);

        if (count($parts) < 3) {
            abort(404); // root domain blocked
        }

        $subdomain = $parts[0];

        $agency = \App\Models\Agency::where('subdomain', $subdomain)
            // ->where('status', 'active')
            ->first();

        if (!$agency) {
            abort(404);
        }

        app()->instance('currentAgency', $agency);

        return $next($request);
    }
}
