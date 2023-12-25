<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Language extends Component
{
    public $label;

    public $name;

    public $placeholder;

    public $dataSelect;

    public $disabled;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param string $placeholder
     * @param array|object $dataSelect
     * @param string|null $disabled
     * @param string|null $required
     */
    public function __construct(string $label, string $name, string $placeholder, object $dataSelect, string $disabled = null, string $required = null)
    {
        $this->label       = label($label);
        $this->placeholder = placeholder($placeholder);
        $this->name        = $name;
        $this->dataSelect  = $dataSelect;
        $this->disabled    = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.language');
    }

    /**
     * Set disabled attribute for tag if another null
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function attrDisabled(): string
    {
        return ($this->disabled != null) ? 'disabled=' . $this->disabled : '';
    }
}
