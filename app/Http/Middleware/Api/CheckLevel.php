<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $level): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        if ((int) $user->level !== (int) $level) {
            return response()->json([
                'message' => 'This action is unauthorized.'
            ], 403);
        }

        return $next($request);
    }
}
