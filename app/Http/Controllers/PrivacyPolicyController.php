<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FAQ;


class PrivacyPolicyController extends Controller
{
    public function show() {
        return view('partials.privacy_policy');
    }
    public function about() {
        return view('pages.about_us',['page_title'=>'About us']);
    }public function faq() {
        $faq = FAQ::getFAQ();
        return view('pages.faq',['page_title'=>'FAQ','faq'=> $faq]);
    }
}
