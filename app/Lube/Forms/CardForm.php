<?php

namespace App\Lube\Forms;

use App\Lube\Fields\AttachmentField;
use App\Lube\Fields\Button;
use App\Lube\Fields\CardDataField;
use App\Lube\Fields\IdField;
use App\Lube\Fields\TextField;

class CardForm extends Form
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

            AttachmentField::make('attachment_id')
                ->label('Card image')
                ->format('card')
                ->hideOnIndex()
                ->rules('required'),

            CardDataField::make('data')
                ->rules('required'),

            Button::make('Submit')
        ];
    }
}
