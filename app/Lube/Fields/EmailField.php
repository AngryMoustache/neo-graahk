<?php

namespace App\Lube\Fields;

class EmailField extends Field
{
    public $component = 'lube.fields.text';
    public $showComponent = 'lube.fields.show.text';

    public $type = 'email';
}
