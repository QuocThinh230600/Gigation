<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Attribute extends Component
{
    public $dataAttr;

    /**
     * Create a new component instance.
     *
     * @param object $data
     */
    public function __construct(object $data = null)
    {
        $this->dataAttr   = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.attribute');
    }
}
