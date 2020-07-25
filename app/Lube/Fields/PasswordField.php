<?php

namespace App\Lube\Fields;

class PasswordField extends Field
{
    public $component = 'lube.fields.text';
    public $showComponent = 'lube.fields.show.text';

    public $type = 'password';
}
