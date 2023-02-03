<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use app\Models\Ganga;

class checkOwnerGanga
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check()){
            abort(403);
        }

        $userId = $request->route('ganga')->user_id;
        $gangauserId = intval($request->user_id);

        if($gangauserId !== $userId){
            abort(403);
        }
        return $next($request);
    }
}
