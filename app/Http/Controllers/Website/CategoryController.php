<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Attribute\AttributeTranslationRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryTranslationRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Page\PageRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductTranslationRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $view = 'website.modules.product';

    private $customer;
    private $config;
    private $image;
    private $product;
    private $productTrans;
    private $attribute;
    private $cateTran;
    private $attributeTrans;
    private $cate;
    private $page;

    public function __construct(PageRepository $page, CategoryRepository $cate, CategoryTranslationRepository $cateTran, CustomerRepository $customer, ConfigRepository $config, AttributeRepository $attribute, ImageRepository $image, ProductRepository $product, ProductTranslationRepository $productTrans, AttributeTranslationRepository $attributeTrans)
    {
        $this->customer = $customer;
        $this->config = $config;
        $this->image = $image;
        $this->product = $product;
        $this->productTrans = $productTrans;
        $this->attribute = $attribute;
        $this->attributeTrans = $attributeTrans;
        $this->cateTran = $cateTran;
        $this->cate = $cate;
        $this->page = $page;
    }

    public function index($slug){
        $config = $this->config->get_all_config();

        $data['meta'] = $this->page->query()->where('id',11)->first();

        $data['error_image']    = $config['error_image'];
        $data['image_platform_support'] = $this->image->getImageWithPositionGet(4,1);

        $data['customer'] = $this->customer->getAll();
        $data['image_client']  = $this->image->getImageWithPositionGet(3,6);
        $data['categorytrans'] = $this->cateTran->getCategoryTranslation($slug);
        $data['category'] = $this->cate->getById($data['categorytrans']->category_id);

        $category_id = $data['categorytrans']->category_id;

        $data['product'] = $this->product->getAllQuery()->whereHas('category_product', function ($query) use ($category_id){
            $query->where('category_id', $category_id)->orderBy('id', 'ASC');
        })->where('status','=', 4)->get();
        
        $data['attributeConfige'] = $this->attribute->query()->where('parent_id', 18)->orderBy('id', 'DESC')->get();

        $data['attributePackage'] = $this->attribute->query()->where('parent_id', 23)->orderBy('id', 'DESC')->get();

        $data['page_detail'] =  $this->cateTran->getCategoryTranslation($slug);

        return view($this->view.'.product_page',$data);
    }
}
