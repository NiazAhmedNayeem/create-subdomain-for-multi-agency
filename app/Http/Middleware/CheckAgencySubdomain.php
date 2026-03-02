<?php

namespace App\Http\Middleware;

use App\Models\Agency;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAgencySubdomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        // example: java.lvh.me

        $parts = explode('.', $host);
        $subdomain = $parts[0];

        $agency = \App\Models\Agency::where('subdomain', $subdomain)->first();

        if (!$agency) {
            abort(404, 'Agency not found');
        }

        if (auth()->check()) {
            if (auth()->user()->agency_id !== $agency->id) {
                abort(403, 'Unauthorized access to this agency');
            }
        }

        // attach agency
        $request->attributes->set('agency', $agency);

        return $next($request);
    }
}
