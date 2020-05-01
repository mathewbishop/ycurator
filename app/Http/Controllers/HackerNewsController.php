<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\News;


class HackerNewsController extends Controller
{
    public function __construct(News $NewsModel)
    {
        $this->News = $NewsModel;
    }

    public function GetArticles(Request $req) 
    {
        // If user is logged in, return articles based on curation criteria. Else, return top 25 from Hacker News
        if ($req->userID) {
            $articles = $this->News->GetCuratedArticles($req->userID);
            return view('index')->with('articles', $articles);
        } else {
            $articles = $this->News->GetArticles();
            return view('index')->with('articles', $articles);
        }

    } 

}

