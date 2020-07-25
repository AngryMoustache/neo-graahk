<?php

namespace App\Http\Controllers\Lube;

use App\Lube\Forms\SetForm;
use App\Models\Set;

class SetsController extends LubeController
{
    public $model = Set::class;
    public $form = SetForm::class;
    public $routeBase = 'sets';

    public $label = 'Set';
    public $labelPlural = 'Sets';

    public $searchable = [
        'name',
        'code',
        'slug'
    ];

    public $slugs = [
        'name' => 'slug'
    ];

    public $habtms = [
        'cards'
    ];

}
