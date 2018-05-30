<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Badge;
use Auth;

class BadgeController extends Controller {
    
    function showAdmin($badge_id) {
        $this->authorize('admin', Auth::user());
        $badge = Badge::find($badge_id);
        return view('partials.admin_badge', ['badge' => $badge]);
    }

    function update(Request $request, $badge_id) {
        $this->authorize('admin', Auth::user());
        $badge = Badge::find($badge_id);
        $badge->name = $request->name;
        $badge->brief = $request->brief;
        $badge->votes = $request->votes;
        $badge->articles = $request->articles;
        $badge->comments = $request->comments;
        $badge->save();
        return view('partials.admin_badge', ['badge' => $badge]);
    }
}
