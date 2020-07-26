<?php

namespace App\Lube\Forms;

use App\Lube\Fields\AttachmentField;
use App\Lube\Fields\Button;
use App\Lube\Fields\HabtmField;
use App\Lube\Fields\IdField;
use App\Lube\Fields\TextField;
use App\Lube\Forms\Form;
use App\Models\Card;

class SetForm extends Form
{
    public function fields()
    {
        return [
            IdField::make('id')
                ->label('ID'),

            TextField::make('name')
                ->rules('required'),

            TextField::make('code')
                ->rules('required'),

            AttachmentField::make('attachment_id')
                ->label('Set icon')
                ->hideOnIndex()
                ->rules('required'),

            HabtmField::make('cards')
                ->relatedItems(Card::get())
                ->label('Cards')
                ->itemLabelKey('name'),

            Button::make('Submit')
        ];
    }
}
