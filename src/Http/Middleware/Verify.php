<?php

namespace Orh\LaravelGiteeWebhooks\Http\Middleware;

use Closure;

class Verify
{
    public function handle($request, Closure $next)
    {
        if (!config('gitee-webhooks.enabled')) {
            return response()->json('This server is disabled.');
        }

        $password = $request->password;

        if (!$password || !hash_equals(config('gitee-webhooks.password'), $password)) {
            return response()->json('Can not be verified.');
        }

        return $next($request);
    }
}
