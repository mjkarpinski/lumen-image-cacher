<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class WarmCache
{
    public function handle(Request $request, Closure $next)
    {
        $hash = md5($request->path());
        $result = DB::table('imagedata')->where('hash', $hash)->first();

        if (isset($result->data)) {
            Redis::set($hash, $result->data);
            return (new Response($result->data))->header('Cached-by', 'sql');
        }

        return $next($request);
    }
}

