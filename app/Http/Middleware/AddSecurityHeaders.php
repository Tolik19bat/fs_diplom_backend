<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddSecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Устанавливаем заголовки безопасности
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        // $response->headers->set('Content-Security-Policy', "frame-ancestors 'self'");
        
        // Если нужно оставить X-Frame-Options для совместимости (необязательно)
        // $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Устанавливаем Content-Type
        // if (str_contains($response->headers->get('Content-Type'), 'application/json')) {
        //     $response->headers->set('Content-Type',
        //      'application/json; charset=utf-8');
        // }

        return $response;
    }
}
