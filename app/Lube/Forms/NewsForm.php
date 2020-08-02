<?php

namespace App\Lube\Forms;

use App\Lube\Fields\AttachmentField;
use App\Lube\Fields\Button;
use App\Lube\Fields\HabtmField;
use App\Lube\Fields\IdField;
use App\Lube\Fields\TextareaField;
use App\Lube\Fields\TextField;
use App\Models\Tag;

class NewsForm extends Form
{
    public function fields()
    {
        return [
            IdField::make('id')
                ->label('ID'),

            TextField::make('title')
                ->rules('required'),

            TextField::make('slug')
                ->hideOnForms()
                ->hideOnIndex(),

            AttachmentField::make('attachment_id')
                ->label('Attachment')
                ->hideOnIndex()
                ->rules('required'),

            TextareaField::make('body')
                ->rules('required')
                ->hideOnIndex(),

            HabtmField::make('tags')
                ->relatedItems(Tag::get())
                ->label('Tags')
                ->itemLabelKey('name'),

            Button::make('Submit')
        ];
    }
}
