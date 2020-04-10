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
        DB::table('keywords')->insert(
            ['user_id' => $req->userID, 'keyword' => $req->keyword]
        );
    }

    public function DeleteKeyword(Request $req)
    {
        foreach($req->keywordIDList as $keyword_id) {
            DB::table('keywords')->delete(
                ['id' => $keyword_id]
            );
        }
    }
}
