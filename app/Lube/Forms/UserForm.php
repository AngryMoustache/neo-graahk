<?php

namespace App\Lube\Forms;

use App\Lube\Fields\Button;
use App\Lube\Fields\CheckboxField;
use App\Lube\Fields\TextField;

class UserForm extends Form
{
    public function fields()
    {
        return [
            TextField::make('id')
                ->hideOnForms()
                ->label('ID'),

            TextField::make('name')
                ->rules('required'),

            TextField::make('email')
                ->rules('required'),

            CheckboxField::make('admin'),

            Button::make('Submit')
        ];
    }
}
