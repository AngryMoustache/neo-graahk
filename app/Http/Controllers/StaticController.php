<?php

namespace App\Http\Controllers;

use App\Models\News;

class StaticController extends Controller
{
    public function home()
    {
        $news = News::limit(3)
            ->orderBy('id', 'desc')
            ->get();

        return view('static.home', [
            'news' => $news
        ]);
    }
}
