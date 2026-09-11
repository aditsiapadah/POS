<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddlewarev
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login')
                ->withErrors(['Silahkan login terlebih dahulu.']);
        }

        $userRole = $request->user()->role->name;

        if (!in_array($userRole, $roles)) {

            return redirect()
                ->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');

        }

        return $next($request);
    }
}
