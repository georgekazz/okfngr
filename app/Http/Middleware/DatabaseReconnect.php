<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseReconnect
{
    public function handle($request, Closure $next)
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            Log::warning('DB connection lost, reconnecting...');
            DB::reconnect();
        }
        return $next($request);
    }
}