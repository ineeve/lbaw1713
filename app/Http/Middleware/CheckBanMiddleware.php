<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use DB;
use Carbon\Carbon;

class CheckBanMiddleware
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
        if (true) {
            $bandata = DB::table('bans')->where('banned_user_id', '=', Auth::id())->first();
            return response()->view('pages.banned', ['bandata' => $bandata]);
        }
        dd("dudedudsfnodignoiefgboeihfoidwgfniodngoidsgoidsgiodngoifnohnd");
        return $next($request);
    }
}