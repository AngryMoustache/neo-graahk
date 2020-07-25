<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HabtmField extends Component
{
    public $fieldName;
    public $selected;
    public $parsedValue;
    public $unselected;

    public function mount($field)
    {
        $this->fieldName = $field->getName();

        $this->selected = $field->getValue()
            ->pluck($field->itemLabelKey ?? 'id', 'id')
            ->toArray();

        $this->unselected = $field->relatedItems
            ->pluck($field->itemLabelKey ?? 'id', 'id')
            ->filter(fn ($value, $key) => !in_array($key, array_keys($this->selected)))
            ->toArray();
    }

    public function render()
    {
        $this->parsedValue = '[' . implode(', ', array_keys($this->selected)) . ']';
        return view('livewire.habtm-field');
    }

    public function select($key)
    {
        $this->selected[$key] = $this->unselected[$key];
        unset($this->unselected[$key]);
    }

    public function unselect($key)
    {
        $this->unselected[$key] = $this->selected[$key];
        unset($this->selected[$key]);
    }
}
