<?php

namespace App\Lube\Forms;

use App\Lube\Fields\Button;
use App\Lube\Fields\TextField;

class CardForm extends Form
{
    public function fields()
    {
        return [
            TextField::make('name'),
            TextField::make('slug'),
            TextField::make('data'),

            Button::make('Submit')
        ];
    }
}
