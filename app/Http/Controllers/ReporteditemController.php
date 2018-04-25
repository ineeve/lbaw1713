<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReporteditemController extends Controller
{
    public function show() {
        return view('pages.reports');
    }
}
