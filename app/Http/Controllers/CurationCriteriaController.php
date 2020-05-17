<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\UserCriteria;

class CurationCriteriaController extends Controller
{
    public function __construct(UserCriteria $UserCriteriaModel)
    {
        $this->UserCriteria = $UserCriteriaModel;
    }

    public function GetKeywordsByUser(Request $req) 
    {
        return $this->UserCriteria->SelectKeywordsByUser($req->userID);
    }

    public function AddKeyword(Request $req)
    {
        $keyword_id = $this->UserCriteria->InsertOneKeyword($req->userID, $req->keyword);
        return $this->UserCriteria->SelectOneKeywordById($keyword_id);
    }

    public function DeleteKeyword(Request $req)
    {
        $this->UserCriteria->DeleteKeywordsById($req->keywordIDList);
    }

    public function GetCommentThreshold(Request $req)
    {
        return $this->UserCriteria->SelectCommentThresholdByUser($req->userID);
    }
    public function SetCommentThreshold(Request $req)
    {
        $this->UserCriteria->UpsertCommentThresholdByUser($req->userID, $req->threshold);
    }
}
