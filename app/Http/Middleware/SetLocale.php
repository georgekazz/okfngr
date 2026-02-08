<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->route('locale'); // παίρνει το {locale} από URL

        if (in_array($locale, ['el','en'])) {
            App::setLocale($locale);
        } else {
            abort(404); // προαιρετικό, ασφαλές
        }

        return $next($request);
    }
}
