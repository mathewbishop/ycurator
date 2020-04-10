<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HackerNewsController extends Controller
{
    public function CurateArticlesByTitle($articleList, $user_id) 
    {
        $curatedArticles = [];
        $keywords = DB::select('select keyword from keywords where user_id = ?', [$user_id]);
        foreach ($articleList as $article) {
            if (isset($article['descendants']) && $article['descendants'] > 250) {
                array_push($curatedArticles, $article);
            } else {
                foreach($keywords as $keyword) {
                    $keywordPadLength = strlen($keyword->keyword) + 2;
                    $paddedKeyword = str_pad($keyword->keyword, $keywordPadLength, " ", STR_PAD_BOTH);
                    // If the keyword is contained in the article title, add it to list
                    if (stripos($article['title'], $paddedKeyword) !== false) {
                        array_push($curatedArticles, $article);
                    }
                }
            }
        }
        return $curatedArticles;
    }

    public function GetArticles(Request $req) 
    {
        $client = new Client();
        $topStoriesResponse = $client->get('https://hacker-news.firebaseio.com/v0/topstories.json');
        $topStoryIDs = json_decode($topStoriesResponse->getBody(), true); 
        $top25IDs = array_slice($topStoryIDs, 0, 25);

        $top25 = [];

        foreach ($top25IDs as $id) {
            $articleResponse = $client->get("https://hacker-news.firebaseio.com/v0/item/$id.json");
            $article = json_decode($articleResponse->getBody(), true);
            array_push($top25, $article);
        }

        if ($req->userID) {
            return $this->CurateArticlesByTitle($top25, $req->userID);     
        } else {
            return $top25;
        }

    } 

}

