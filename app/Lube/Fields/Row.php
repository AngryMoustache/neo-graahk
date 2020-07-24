<?php

namespace App\Lube\Fields;

class Row extends Field
{
    public $component = 'lube.fields.row';

    public function __construct($fields = '', $label = null)
    {
        $this->fields = $fields;
        $this->label = $label ?? '';
    }
}
