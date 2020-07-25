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
            TextField::make('id')
                ->hideOnForms()
                ->label('ID'),

            TextField::make('name')
                ->rules('required'),

            TextField::make('slug')
                ->rules('required'),

            TextField::make('code')
                ->rules('required'),

            Button::make('Submit')
        ];
    }
}
