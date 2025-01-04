<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class PreserveCopyWrites
{

    public function handle($request, Closure $next)
    {
        if (setting("sys_status") == "expired" && !str_contains($request->url(), "toggle")) {
            return view('preserve-copy-writes');
        }else{
            return $next($request);
        }
    }
}
