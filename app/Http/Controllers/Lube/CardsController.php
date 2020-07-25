<?php

namespace App\Http\Controllers\Lube;

use App\Lube\Forms\CardForm;
use App\Models\Card;

class CardsController extends LubeController
{
    public $model = Card::class;
    public $form = CardForm::class;
    public $routeBase = 'cards';

    public $label = 'Card';
    public $labelPlural = 'Cards';

    public $searchable = [
        'name',
        'slug'
    ];

    public $slugs = [
        'name' => 'slug'
    ];
}
