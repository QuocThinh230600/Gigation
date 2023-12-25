<?php

namespace App\Http\Controllers\Administrator;

use App\Repositories\District\DistrictRepository;
use App\Repositories\Ward\WardRepository;
use Illuminate\Http\Request;

class AjaxController extends AdminController
{
    private $district;

    private $ward;

    /**
     * AjaxController constructor.
     * @param DistrictRepository $district
     * @param WardRepository $ward
     */
    public function __construct(DistrictRepository $district,
                                WardRepository $ward)
    {
        parent::__construct();
        $this->district = $district;
        $this->ward     = $ward;
    }

    /**
     * Add row upload images in news or product
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function addRowUploadImage(Request $request)
    {
        $data["imageDefault"] = asset(GLOBAL_ASSETS_IMG . 'placeholders/placeholder.jpg');
        $data["id"]           = $request->id;
        $data["position"]     = $request->position;
        $view                 = view('components.ajax_images', $data)->render();

        return response()->json(
            [
                'view' => $view
            ]
        );
    }

    /**
     * Add row attribute in product
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function addRowUploadAttribute(Request $request)
    {
        $data["id"] = $request->id;
        $view       = view('components.ajax_attribute', $data)->render();

        return response()->json(
            [
                'view' => $view
            ]
        );
    }

    /**
     * Get district by province
     * @param Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getDistrict(Request $request)
    {
        $xhtml = '<option value="">' . label('address.please_choose_district') . '</option>';

        $province = $request->province_id;

        if (!empty($province)) {
            $districts = $this->district->getDistrictByProvince($province);

            foreach ($districts as $district) {
                $xhtml .= '<option value="' . $district->id . '">' . $district->name . '</option>';
            }
        }

        return $xhtml;
    }

    /**
     * Get ward by district
     * @param Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function getWard(Request $request)
    {
        $xhtml = '<option value="">' . label('address.please_choose_ward') . '</option>';

        $district = $request->district_id;

        if (!empty($district)) {
            $wards = $this->ward->getWardByDistrict($district);

            foreach ($wards as $ward) {
                $xhtml .= '<option value="' . $ward->id . '">' . $ward->name . '</option>';
            }
        }

        return $xhtml;
    }

    /**
     * Render html notification
     * @param Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function addNotification(Request $request)
    {
        $data       = $request->data;
        $view       = view('components.ajax_notification', $data)->render();
        return $view;
    }

    /**
     * Make as read notification
     * @param Request $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function MakeAsReadNoti(Request $request)
    {
        auth()->user()->unreadNotifications->where('id', $request->id)->markAsRead();
    }
}
