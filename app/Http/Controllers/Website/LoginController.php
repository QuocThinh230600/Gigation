<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Website\LoginRequest;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Page\PageRepository;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $image;
    private $category;
    private $page;

    public function __construct(ImageRepository $image, CategoryRepository $category, PageRepository $page)
    {
        $this->image = $image;
        $this->category = $category;
        $this->page = $page;
    }


    function index(){
        $data['meta'] = $this->page->query()->where('id',16)->first();

        $data['image_banner'] = $this->image->getImageWithPositionGet(6,1);
        $data['category'] = $this->category->getAllCategoryByParent(8);

        return view('website.modules.login.login_page', $data);
    }

    /**
     * Account login processing
     * @param LoginRequest $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function login(LoginRequest $request)
    {
        $remember = ($request->remember) ? true : false;

        $login = array(
            'email'    => $request->email,
            'password' => $request->password,
            'status'   => 'on'
        );

        if (Auth::attempt($login, $remember)) {

            return response()->json([
                'status'       => 'success',
                'message'      => message('login.success'),
                'redirect'     => route('home')
            ], 200);
        } else {
            return response()->json([
                'status'  => 'fail',
                'message' => message('login.fail'),
            ], 401);
        }
    }


}
