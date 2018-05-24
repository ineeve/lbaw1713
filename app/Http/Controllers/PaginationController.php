<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginationController extends Controller
{
    public function getPagination(Request $request){
        $currentPage = $request->pageNumber;
        $numberOfPages = $request->numberOfPages;
        return view('partials.pagination', 
            ['numberOfPages' => $numberOfPages,
            'currentPage'=> $currentPage]);
    }
}
