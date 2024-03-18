<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;

class ForceJsonResponseMiddleware
{
    use ApiResponseTrait;
    public function handle(Request $request, Closure $next)
    {
        $acceptHeader = $request->header('Accept');
        if ($acceptHeader != 'application/json') {
            return $this->acceptHeader();
        }
        return $next($request);
    }
}
