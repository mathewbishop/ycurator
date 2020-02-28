<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Storage;

class HackerNewsController extends Controller
{
    public function CurateArticlesByTitle($articleList) 
    {
        $curatedArticles = [];
        $keywords = explode(",", Storage::get('keywords.txt'));
        foreach ($articleList as $article) {
            $commentCount = urldecode($article['descendants']);
            if ($commentCount > 250) {
                array_push($curatedArticles, $article);
            } else {
                foreach($keywords as $keyword) {
                    // If the keyword is contained in the article title, add it to list
                    if (stripos($article['title'], $keyword) !== false) {
                        array_push($curatedArticles, $article);
                    }
                }
            }
        }
        return $curatedArticles;
        // return $keywords;
    }

    public function GetArticles() 
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

        return $this->CurateArticlesByTitle($top25);        

        // return $top25;
        // Storage::put('tempstore.txt', json_encode($top25));
    } 

    public function GetTestData()
    {
        $data = Storage::get('tempstore.txt');
        return json_decode($data, true);
    }

}

