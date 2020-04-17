<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Keywords extends Model
{
    public function SelectKeywordsByUser($userID)
    {
        $user_keywords = DB::table('keywords')->select('keyword')->where('user_id', '=', $userID);
        return $user_keywords;
    }
}
