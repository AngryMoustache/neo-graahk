<?php

namespace App\Http\Controllers\Lube;

use App\Lube\Forms\NewsTagForm;
use App\Models\Tag;

class NewsTagsController extends LubeController
{
    public $model = Tag::class;
    public $form = NewsTagForm::class;
    public $routeBase = 'tags';

    public $label = 'News Tag';
    public $labelPlural = 'News Tags';

    public $searchable = [
        'name'
    ];

    public $slugs = [
        'name' => 'slug'
    ];
}
