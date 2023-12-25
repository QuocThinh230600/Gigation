<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Selectbox extends Component
{
    public $label;

    public $name;

    public $dataSelect;

    public $uuid;

    public $disabled;

    public $required;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param array $dataSelect
     * @param bool $uuid
     * @param string|null $disabled
     * @param string|null $required
     */
    public function __construct(string $label, string $name, $dataSelect = array(), bool $uuid = false, string $disabled = null, string $required = null)
    {
        $this->label      = label($label);
        $this->name       = $name;
        $this->dataSelect = $dataSelect;
        $this->uuid       = $uuid;
        $this->disabled   = $disabled;
        $this->required   = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.selectbox');
    }

    /**
     * Set id attribute for tag if another null
     * @param object $item
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function attrId(object $item): string
    {
        return ($this->uuid) ? $item->uuid : (string)$item->id;
    }

    /**
     * Set disabled attribute for tag if nother null
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
