<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;

    public $module;

    public $id;

    public $table;

    /**
     * Create a new component instance.
     *
     * @param string|null $title
     * @param string|null $module
     * @param string|null $id
     * @param string|null $table
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(string $title = null, string $module = null, string $id = null, string $table = null)
    {
        $this->title = (is_null($title)) ? module($module) : behavior($title);
        $this->id    = $id;
        $this->table = $table;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }

    /**
     * Set id attribute for tag if another null
     * @return string
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function attrId(): string
    {
        return ($this->id != null) ? 'id=' . $this->id : '';
    }
}
