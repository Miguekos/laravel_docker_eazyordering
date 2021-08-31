<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = is_null(session('locale')) ? Config::get('app.locale') : session('locale');
        if (in_array($locale, ['en', 'es', 'it'])) {
            App::setLocale($locale);
        }
        return $next($request);
    }
}