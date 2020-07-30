<?php

namespace App\Http\Controllers\Lube;

use App\Lube\Forms\FormatForm;
use App\Models\Format;

class FormatsController extends LubeController
{
    public $model = Format::class;
    public $form = FormatForm::class;
    public $routeBase = 'formats';

    public $label = 'Format';
    public $labelPlural = 'Formats';

    public $searchable = [
        'name',
        'slug'
    ];

    public $slugs = [
        'name' => 'slug'
    ];

    public $habtms = [
        'cards',
        'sets'
    ];

}
