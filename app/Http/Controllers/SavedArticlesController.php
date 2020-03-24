<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SavedArticlesController extends Controller
{
    public function SavedArticles() 
    {
        return view('saved-articles');
    }

    public function SaveArticle(Request $req)
    {
        $user_id = Auth::id();
        DB::table('saved_articles')->insert(
            ['user_id' => $user_id, 'title' => $req->title, 'comment_count' => $req->commentCount, 'article_url' => $req->articleUrl, 'discussion_url' => $req->discussionUrl]
        );
    }
}
