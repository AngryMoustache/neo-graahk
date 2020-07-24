<?php

namespace App\Lube\Fields;

class Field
{
    public $containsFile = false;

    public $groupPrefixes = [];

    public $uniqueId;

    public function render()
    {
        return view($this->component, [
            'field' => $this
        ]);
    }

    public function __construct($name, $label = null)
    {
        $this->name = $name;
        $this->label = $label ?? ucfirst(str_replace('_', ' ', $name));
        $this->uniqueId = uniqid();
    }

    public static function make($name = '', $label = null)
    {
        return new static($name, $label);
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    public function __call($name, $value)
    {
        if ($value === []) {
            $this->{$name} = true;
        } else if (count($value) > 1) {
            $this->{$name} = $value;
        } else {
            $this->{$name} = optional($value)[0];
        }

        return $this;
    }

    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    public function getName($usePrefixes = true)
    {
        $name = $this->name;

        if (isset($this->prefix)) {
            $name = "{$this->prefix}_{$name}";
        }

        if (isset($this->suffix)) {
            $name = "{$name}_{$this->suffix}";
        }

        if ($usePrefixes && $this->groupPrefixes !== []) {
            return implode('.', $this->groupPrefixes) . '.' . $name;
        }

        return $name;
    }

    public function getValue($doConditionalChecks = false)
    {
        return optional(session('item'))->{$this->getName()}
            ?? $this->value
            ?? $this->default
            ?? null;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getDefaultValueOrNull()
    {
        return $this->default ?? $this->value ?? null;
    }

    public function getNestedFields()
    {
        return $this->fields ?? $this;
    }
}
