<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Agency;

class IdentifyAgency
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost(); // example: niaz.lvh.me
        $parts = explode('.', $host);

        if (count($parts) < 3) {
            abort(404, 'Root domain access blocked');
        }

        $subdomain = $parts[0];

        $agency = Agency::where('subdomain', $subdomain)->first();

        if (!$agency) {
            abort(404, 'Agency not found');
        }

        // attach agency to request
        $request->attributes->set('agency', $agency);

        // attach agency globally
        app()->instance('currentAgency', $agency);

        // auth check and redirect
        if (Auth::check() && Auth::user()->agency_id !== $agency->id) {
            Auth::logout();
            return redirect('/login')->with('error', 'Unauthorized access to this agency');
        }

        return $next($request);
    }

}
