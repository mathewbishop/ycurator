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
            return $this->News->GetCuratedArticles($req->userID);
        } else {
            return $this->News->GetArticles();
        }

    } 

}

