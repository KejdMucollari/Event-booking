<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        $roleMap = [
            'admin' => 1,
            'organizer' => 2,
            'user' => 3,
        ];

        $allowedIds = array_map(fn($r) => $roleMap[$r], $roles);


        if (!in_array($user->role_id, $allowedIds)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
