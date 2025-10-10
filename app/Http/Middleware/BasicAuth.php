<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = env('ADMIN_USER', 'admin');
        $pass = env('ADMIN_PASS', 'admin');

        if ($request->getUser() !== $user || $request->getPassword() !== $pass) {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic realm="Admin"']);
        }

        return $next($request);
    }
}