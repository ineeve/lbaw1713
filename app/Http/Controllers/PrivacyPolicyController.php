<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function show() {
        return view('partials.privacy_policy');
    }
}
