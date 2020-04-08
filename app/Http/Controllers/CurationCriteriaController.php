<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CurationCriteriaController extends Controller
{
    public function GetKeywordsByUser(Request $req) 
    {
        $keywords = DB::select('select * from keywords where user_id = ?', [$req->userID]);
        return $keywords;
    }

    public function AddKeyword(Request $req)
    {
        
    }

    public function DeleteKeyword(Request $req)
    {

    }
}