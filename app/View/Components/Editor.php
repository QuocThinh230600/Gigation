<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Editor extends Component
{
    public $label;

    public $name;

    public $editor;

    public $height;

    public $disabled;

    public $required;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param bool $editor
     * @param int|null $height
     * @param string|null $disabled
     * @param string|null $required
     */
    public function __construct(string $label, string $name, bool $editor = true, int $height = null, string $disabled = null, string $required = null)
    {
        $this->label    = label($label);
        $this->name     = $name;
        $this->editor   = $editor;
        $this->height   = $height;
        $this->disabled = $disabled;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.editor');
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
