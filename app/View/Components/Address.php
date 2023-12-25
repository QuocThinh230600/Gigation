<?php

namespace App\View\Components;

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\View\Component;

class Address extends Component
{
    public $province;

    public $district;

    public $ward;

    public $province_selected;

    public $district_selected;

    public $ward_selected;

    /**
     * Create a new component instance.
     * @param int|null $provinceSelected
     * @param int|null $districtSelected
     * @param int|null $wardSelected
     */
    public function __construct(int $provinceSelected = null, int $districtSelected = null, int $wardSelected = null)
    {
        $this->province_selected = $provinceSelected;
        $this->district_selected = $districtSelected;
        $this->ward_selected     = $wardSelected;
        $this->province          = Province::all();
        if ($provinceSelected != null) {
            $this->district = District::where('province_id', $provinceSelected)->get();
        }

        if ($districtSelected != null) {
            $this->ward = Ward::where('district_id', $districtSelected)->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.address');
    }
}
