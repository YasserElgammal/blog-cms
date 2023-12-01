<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugModeOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (config('app.debug')) {
            return $next($request);
        }

        return response()->json(['message' => 'Command execution is only allowed in debug mode']);
    }
}
