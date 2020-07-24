<?php

namespace App\Lube\Fields;

class CountryField extends SelectField
{
    public $component = 'lube.fields.select';

    public function __construct($name, $label = null)
    {
        parent::__construct($name, $label = null);
        $this->options = getCountryList();
    }
}
