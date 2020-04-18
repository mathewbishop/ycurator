<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserCriteria extends Model
{
    // Keyword Methods
    public function SelectKeywordsByUser($user_id)
    {
        $user_keywords = DB::table('keywords')->where('user_id', '=', $user_id)->get();
        return $user_keywords;
    }

    public function InsertOneKeyword($user_id, $keyword)
    {
        DB::table('keywords')->insert(['user_id' => $user_id, 'keyword' => $keyword]);
    }

    public function DeleteKeywordsById($keyword_id_list)
    {
        foreach ($keyword_id_list as $keyword_id) {
            DB::table('keywords')->where('id', '=', $keyword_id)->delete();
        }
    }

    // Comment Threshold Methods
    public function SelectCommentThresholdByUser($user_id)
    {
        $user_comment_threshold = DB::table('user_comment_threshold')->select('comment_threshold')->where('user_id', '=', $user_id)->get();
        return $user_comment_threshold;
    }

    public function UpsertCommentThresholdByUser($user_id, $comment_threshold)
    {
        DB::table('user_comment_threshold')->updateOrInsert(
            ['user_id' => $user_id],
            ['comment_threshold' => $comment_threshold]
        );
    }
}
