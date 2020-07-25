<?php

namespace App\Lube\Fields;

class SelectField extends Field
{
    public $component = 'lube.fields.select';
    public $showComponent = 'lube.fields.show.select';

    public $options = [];

    public $value = '';
}
