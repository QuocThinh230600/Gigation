<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\customer;
use App\Repositories\Advantages\AdvantagesRepository;
use App\Repositories\Attribute\AttributeTranslationRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductTranslationRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $view = 'website.modules.product';

    private $customer;
    private $config;
    private $image;
    private $productTrans;
    private $advantages;
    private $product;
    private $attributeTrans;

    public function __construct(
        CustomerRepository $customer,
        ConfigRepository $config,
        ImageRepository $image,
        ProductTranslationRepository $productTrans,
        AdvantagesRepository $advantages,
        ProductRepository $product,
        AttributeTranslationRepository $attributeTrans
    ) {
        $this->customer = $customer;
        $this->config = $config;
        $this->image = $image;
        $this->productTrans = $productTrans;
        $this->advantages = $advantages;
        $this->product = $product;
        $this->attributeTrans = $attributeTrans;
    }

    public function index($slug = null)
    {
        $config = $this->config->get_all_config();

        // $data['error_image']    = $config['error_image'];
        // $data['image_platform_support'] = $this->image->getImageWithPositionGet(4, 1);
        // $data['customer'] = $this->customer->getAll();
        // $data['image_client']  = $this->image->getImageWithPositionGet(3, 6);
        // $data['producttrans'] = $this->productTrans->getProductTranslation($slug);
        // $data['product'] = $this->product->getById($data['producttrans']->product_id);

        // dd($data['product'] );

        // return view($this->view . '.product_page', $data);
    }
}
