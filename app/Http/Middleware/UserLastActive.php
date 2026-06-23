<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserLastActive
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! empty($request->user())) {
            if ($last_active_at = session('last_active_at')) {
                if (now()->subMinutes(2)->lessThan($last_active_at)) {
                    User::where('id', $request->user()->id)->update([
                        'last_active_at' => now(),
                    ]);
                }
            } else {
                session(['last_active_at' => now()]);
                User::where('id', $request->user()->id)->update([
                    'last_active_at' => now(),
                ]);
            }
        }

        return $next($request);
    }
}
