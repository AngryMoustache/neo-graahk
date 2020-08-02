<?php

namespace App\Http\Controllers\Lube;

use App\Lube\Forms\TagForm;
use App\Models\Tag;

class TagsController extends LubeController
{
    public $model = Tag::class;
    public $form = TagForm::class;
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
