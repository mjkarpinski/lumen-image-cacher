<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class Cache
{
    public function handle(Request $request, Closure $next)
    {
        $hash = md5($request->path());
        $cache = Redis::get($hash);

        if ($cache) {
            return (new Response($cache))->header('Cached-by', 'redis');
        }

        return $next($request);
    }
}

