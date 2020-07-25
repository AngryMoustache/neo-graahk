<?php

namespace App\Lube\Forms;

use App\Lube\Fields\Button;
use App\Lube\Fields\FileField;
use App\Lube\Fields\IdField;
use App\Lube\Fields\TextField;

class AttachmentForm extends Form
{
    public function fields()
    {
        return [
            IdField::make('id')
                ->label('ID'),

            FileField::make('image')
                ->rules('required'),

            TextField::make('alt_name')
                ->label('Alternative name')
                ->rules('required'),

            Button::make('Submit')
        ];
    }
}
