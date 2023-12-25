<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\TestNotification;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Content\ContentRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Page\PageRepository;
use Illuminate\Http\Request;
use Pusher\Pusher;

class RegisterController extends Controller
{
    private $category;
    private $image;
    private $contact;
    private $page;
    private $content;

    function __construct(CategoryRepository $category,
                        ContactRepository $contact,
                        ImageRepository $image, 
                        PageRepository $page,
                        ContentRepository $content)
    {
        $this->category = $category;
        $this->contact  = $contact;
        $this->image    = $image;
        $this->page     = $page;
        $this->content  = $content;
    }

    function index(){
        $data['meta']           = $this->page->query()->where('id',17)->first();
        $data['categoryName']   = $this->category->query()->with('category_translation')->where('parent_id', '=', 8)->get();
        $data['image_banner']   = $this->image->getImageWithPositionGet(7,1);
        $data['content']        = $this->content->getContentWithPage(17);


        return view('website.modules.register.register_page',$data);
    }

    public function register (Request $request)
    {
        $contact = $request->except('_token');
        $contact = $this->contact->create($contact);

        $alert   ='Bạn đã đăng kí thông tin thành công!';

        return redirect()->back()->with('alert',$alert);
    }
}
