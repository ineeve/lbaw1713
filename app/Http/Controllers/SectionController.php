<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Section;

class SectionController extends Controller {
    
    /**
     * Add a new Category.
     */
    public function addCategory(Request $request) {
        $this->authorize('admin', Auth::user());
        $category = new Section;
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->save();

        return back();
    }

    /**
     * Edit a Category's name and icon.
     */
    public function editCategory(Request $request, $categoryId) {
        $this->authorize('admin', Auth::user());
        $category = Section::find($categoryId);
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->save();
    }
}
