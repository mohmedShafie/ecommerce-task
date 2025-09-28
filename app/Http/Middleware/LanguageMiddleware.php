<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->get('locale', $request->header('Accept-Language', 'en'));

        // Support for common locale formats
        if (str_contains($locale, '-')) {
            $locale = explode('-', $locale)[0];
        }

        // Validate and set locale
        $supportedLocales = ['ar', 'en'];
        if (in_array($locale, $supportedLocales)) {
            app()->setLocale($locale);
        } else {
            app()->setLocale('en');
        }

        return $next($request);
    }
}
