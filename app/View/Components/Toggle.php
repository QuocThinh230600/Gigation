<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toggle extends Component
{
    public $label;

    public $name;

    public $on;

    public $off;

    public $uuid;

    public $id;

    public $column;

    public $table;

    public $disabled;

    public $required;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param string $on
     * @param string $off
     * @param string|null $uuid
     * @param string|null $id
     * @param string|null $column
     * @param string|null $table
     * @param string|null $disabled
     * @param string|null $required
     */
    public function __construct(string $label, string $name, string $on, string $off, string $uuid = null, string $id = null, string $column = null, string $table = null, string $disabled = null, string $required = null)
    {
        $this->label    = label($label);
        $this->name     = $name;
        $this->on       = label($on);
        $this->off      = label($off);
        $this->uuid     = $uuid;
        $this->id       = $id;
        $this->column   = $column;
        $this->table    = $table;
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
        return view('components.toggle');
    }

    /**
     * Set Disabled Attribute For Tag If Another Null
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
