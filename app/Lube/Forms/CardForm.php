<?php

namespace App\Lube\Forms;

use App\Lube\Fields\AttachmentField;
use App\Lube\Fields\Button;
use App\Lube\Fields\CardDataField;
use App\Lube\Fields\CardStatsField;
use App\Lube\Fields\HabtmField;
use App\Lube\Fields\IdField;
use App\Lube\Fields\TextField;
use App\Models\Set;

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

            CardStatsField::make('stats'),

            CardDataField::make('data')
                ->hideOnIndex(),

            HabtmField::make('sets')
                ->relatedItems(Set::get())
                ->label('Sets')
                ->itemLabelKey('name'),

            Button::make('Submit')
        ];
    }
}
