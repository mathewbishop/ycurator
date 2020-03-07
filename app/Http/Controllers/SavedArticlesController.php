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

    public function SaveArticle($article)
    {
        $user_id = Auth::id();
        DB::table('saved_articles')->insert(
            ['user_id' => $user_id, 'title' => $article->title, 'comment_count' => $article->commentCount, 'article_url' => $article->articleUrl, 'discussion_url' => $article->discussionUrl]
        );
    }
}
