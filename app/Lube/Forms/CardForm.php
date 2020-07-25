<?php

namespace App\Lube\Forms;

use App\Lube\Fields\AttachmentField;
use App\Lube\Fields\Button;
use App\Lube\Fields\TextField;

class CardForm extends Form
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

            TextField::make('data')
                ->rules('required'),

            AttachmentField::make('attachment_id')
                ->label('Card image')
                ->format('card')
                ->hideOnIndex()
                ->rules('required'),

            Button::make('Submit')
        ];
    }
}
