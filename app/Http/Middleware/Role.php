<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (!auth('sanctum')->check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return response()->json(['success' => false, 'message' => 'Please Log in']);

        $user = auth('sanctum')->user();
        foreach ($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if ($user->role->value == $role)
                return $next($request);
        };

        return response()->json([
            'success' => false,
            'message' => "You don't have enough permission"
        ]);
    }
}
