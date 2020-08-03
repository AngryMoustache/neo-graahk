<?php

namespace App\Lube\Forms;

use App\Lube\Fields\AttachmentField;
use App\Lube\Fields\Button;
use App\Lube\Fields\ColorField;
use App\Lube\Fields\HabtmField;
use App\Lube\Fields\IdField;
use App\Lube\Fields\TextareaField;
use App\Lube\Fields\TextField;
use App\Lube\Forms\Form;
use App\Models\Card;
use App\Models\Set;

class FormatForm extends Form
{
    public function fields()
    {
        return [
            IdField::make('id')
                ->label('ID'),

            TextField::make('name')
                ->rules('required'),

            TextareaField::make('description')
                ->hideOnIndex(),

            ColorField::make('color')
                ->rules('required'),

            HabtmField::make('sets')
                ->relatedItems(Set::get())
                ->label('Sets')
                ->itemLabelKey('name'),

            HabtmField::make('cards')
                ->relatedItems(Card::get())
                ->label('Cards')
                ->itemLabelKey('name')
                ->hideOnIndex(),

            Button::make('Submit')
        ];
    }
}
