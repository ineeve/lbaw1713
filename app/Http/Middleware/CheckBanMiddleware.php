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
        if (!$request->is('logout') && Auth::check() && Auth::user()->ban()->exists()) {
            $bandata = DB::table('bans')->where('banned_user_id', Auth::id())->first();
            $admin = User::find($bandata->admin_user_id);
            return response()->view('pages.banned', ['banner_name' => $admin->username,
                                                    'date' => $bandata->date,
                                                    'reason' => $bandata->reason]);
        }
        return $next($request);
    }
}