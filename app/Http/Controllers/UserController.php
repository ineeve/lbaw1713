<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show() {
        return view('partials.privacy_policy');
    }
    public function edit() {
        return view('pages.profile_edit');
    }
}
