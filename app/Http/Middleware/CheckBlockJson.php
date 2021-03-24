<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CheckBlockJson
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
        $user = $this->user= auth()->user();
        if ($user->hasRole('blocked')) {
            $response = [
                'success' => false,
                'message' => 'Your account is blocked',
            ];
            return response()->json($response, 403);
        }
        return $next($request);
    }
}
