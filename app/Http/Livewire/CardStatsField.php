<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CardStatsField extends Component
{
    public $data;
    public $fields;
    public $types;
    public $selectedType;
    public $fieldName;
    public $hiddenField;

    public function mount($field)
    {
        $this->fieldName = $field->getName();
        $this->data = (array)json_decode($field->getValue() ?? "{}", true);
        $this->fields = config('card-stats', []);
        $this->types = array_keys(config('card-stats', []));
    }

    public function render()
    {
        $this->hiddenField = json_encode($this->data);
        return view('livewire.card-stats-field');
    }
}
