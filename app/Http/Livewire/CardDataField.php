<?php

namespace App\Http\Livewire;

use App\CardText;
use Livewire\Component;

class CardDataField extends Component
{
    public $hiddenField;
    public $data;
    public $events;
    public $fieldName;
    public $triggers;
    public $parameters;
    public $previewText;
    public $editingTrigger;
    public $pickingEvent;

    public function mount($field)
    {
        $this->triggers = config('card-data.triggers', []);
        $this->events = array_keys(config('card-data.events', []));
        $this->parameters = config('card-data.events', []);

        $this->fieldName = $field->getName();
        $this->data = (array)$field->getValue() ?? "{}";
    }

    public function render()
    {
        $this->previewText = CardText::parse($this->data);
        $this->hiddenField = json_encode($this->data);

        return view('livewire.card-data-field');
    }

    public function addTrigger()
    {
        $this->data[] = [];
    }

    public function editTrigger($key)
    {
        $this->editingTrigger = $key;
    }

    public function deleteTrigger($key)
    {
        unset($this->data[$key]);
    }

    public function deleteEvent($key, $eKey)
    {
        unset($this->data[$key]['events'][$eKey]);
    }

    public function closeModal()
    {
        $this->editingTrigger = null;
    }

    public function addEvent($key)
    {
        $this->data[$key]['events'][] = [
            'event' => $this->pickingEvent,
            'parameters' => collect(array_keys($this->parameters[$this->pickingEvent] ?? []))
                ->mapWithKeys(fn ($value) => [$value => null])
                ->toArray()
        ];

        $this->pickingEvent = null;
    }
}
