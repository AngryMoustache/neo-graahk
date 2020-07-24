<?php

namespace App\Lube\Forms;

use App\Lube\Fields\Button;
use App\Lube\Fields\TextField;
use App\Lube\Forms\Form;

class SetForm extends Form
{
    public function fields()
    {
        return [
            TextField::make('name'),
            TextField::make('slug'),
            TextField::make('code'),
            Button::make('Submit')
        ];
    }
}
