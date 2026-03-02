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
        $subdomain = explode('.', $request->getHost())[0]; // niaz.saas.local
        $agency = Agency::where('subdomain', $subdomain)->first();

        if (!$agency) abort(404, "Agency not found");

        $request->merge(['current_agency' => $agency]);

        return $next($request);
    }
}
