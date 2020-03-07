<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavedArticlesController extends Controller
{
    public function savedArticles() 
    {
        return view('saved-articles');
    }
}
