<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class News extends Model
{
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
        return $top25;
    }

    public function GetCuratedArticles($user_id)
    {
        $top25 = $this->GetArticles();
        $curatedArticles = [];
        $keywords = DB::select('select keyword from keywords where user_id = ?', [$user_id]);
        $threshold = DB::select('select comment_threshold from user_comment_threshold where user_id = ?', [$user_id]);
        foreach ($top25 as $article) {
            if ($threshold && isset($article['descendants']) && $article['descendants'] > $threshold[0]->comment_threshold) {
                array_push($curatedArticles, $article);
            } else {
                foreach($keywords as $keyword) {
                    // If the keyword is contained in the article title, add it to list
                    if (stripos($article['title'], $keyword->keyword) !== false) {
                        // Only add an article to the final array once
                        if (!in_array($article, $curatedArticles)) {
                            array_push($curatedArticles, $article);
                        }
                    }
                }
            }
        }
        return $curatedArticles;
    }
}
