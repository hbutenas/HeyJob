<?php

namespace App\Http\Middleware\Api\V1\Auth;

use App\Traits\HttpResponses;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateType
{
    use HttpResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$type): Response
    {
        if (!in_array($request->user()->type, $type)) {
            return $this->failedRequest('', 'You are not authorized to enter this route', 403);
        }

        return $next($request);
    }
}
