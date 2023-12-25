<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Image extends Component
{
    public $name;

    /**
     * Create a new component instance.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.image');
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
