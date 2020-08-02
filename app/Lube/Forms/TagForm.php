<?php

namespace App\Lube\Forms;

use App\Lube\Fields\Button;
use App\Lube\Fields\IdField;
use App\Lube\Fields\TextField;

class TagForm extends Form
{
    public function fields()
    {
        return [
            IdField::make('id')
                ->label('ID'),

            TextField::make('name')
                ->rules('required'),

            TextField::make('slug')
                ->hideOnForms()
                ->hideOnIndex(),

            Button::make('Submit')
        ];
    }
}
