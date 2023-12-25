<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Images extends Component
{
    public $dataImg;

    /**
     * Create a new component instance.
     *
     * @param object $data
     */
    public function __construct(object $data = null)
    {
        $this->dataImg = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.images');
    }

    /**
     * Render image default
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function imageDefault(): string
    {
        return asset(GLOBAL_ASSETS_IMG . 'placeholders/placeholder.jpg');
    }
}
