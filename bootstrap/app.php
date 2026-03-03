<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\CheckAgencySubdomain;
use App\Http\Middleware\IdentifyAgency;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/agency.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {
        
        $middleware->redirectGuestsTo(function ($request) {
            $host = $request->getHost();
            $parts = explode('.', $host);

            if (count($parts) >= 3) {
                $subdomain = $parts[0];
                return route('agency.login', ['subdomain' => $subdomain]);
            }
            return route('agency.login');
        });

        $middleware->alias([
            'super_admin' => SuperAdminMiddleware::class,
            'check.agency' => CheckAgencySubdomain::class,
            'identify.agency' => IdentifyAgency::class,
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
