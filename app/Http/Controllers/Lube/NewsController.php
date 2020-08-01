<?php

namespace App\Http\Controllers\Lube;

use App\Lube\Forms\NewsForm;
use App\Models\News;

class NewsController extends LubeController
{
    public $model = News::class;
    public $form = NewsForm::class;
    public $routeBase = 'news';

    public $label = 'News';
    public $labelPlural = 'News';

    public $searchable = [
        'title',
        'body',
    ];

    public $slugs = [
        'title' => 'slug'
    ];

    public $habtms = [
        'newsTags'
    ];
}
