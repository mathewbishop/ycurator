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
        return DB::table('user_keywords')->where('user_id', '=', $user_id)->orderBy('id', 'asc')->get();
    }

    public function InsertOneKeyword($user_id, $keyword)
    {
        return DB::table('user_keywords')->insertGetId(['user_id' => $user_id, 'keyword' => $keyword]);
    }

    public function DeleteKeywordsById($keyword_id_list)
    {
        foreach ($keyword_id_list as $keyword_id) {
            DB::table('user_keywords')->where('id', '=', $keyword_id)->delete();
        }
    }

    public function SelectOneKeywordById($id)
    {
        return DB::table('user_keywords')->where('id', '=', $id)->get();
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
