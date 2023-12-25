<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tag extends Component
{
    public $label;

    public $name;

    public $placeholder;

    public $required;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param string $placeholder
     * @param string|null $required
     */
    public function __construct(string $label, string $name, string $placeholder, string $required = null)
    {
        $this->label       = label($label);
        $this->name        = $name;
        $this->placeholder = placeholder($placeholder);
        $this->required    = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tag');
    }

    /**
     * Add html required
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function attrRequired(): string
    {
        return ($this->required != null) ? '<span class="text-danger">*</span>' : '';
    }
}
