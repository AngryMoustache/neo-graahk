<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CardDataField extends Component
{
    public $fieldName;

    public function mount($field)
    {
        $this->fieldName = $field->getName();
    }

    public function render()
    {
        return view('livewire.card-data-field');
    }
}
