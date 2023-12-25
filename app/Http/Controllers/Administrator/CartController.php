<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Repositories\Cart\PaydetailsRepository;
use App\Repositories\Cart\PayorderRepository;
use Yajra\DataTables\DataTables;

class CartController extends AdminController
{
    private $view = 'administrator.modules.cart.';

    private $route = 'admin.cart.';

    private $module = 'module.cart';

    private $payorder;

    private  $paydetail;

    /**
     * ConfigController constructor.
     * @param ConfigRepository $config
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(PaydetailsRepository $paydetail,PayorderRepository $payorder)
    {
        parent::__construct();

        $this->payorder = $payorder;
        $this->paydetail = $paydetail;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        return view($this->view . 'index');
    }

   /**
     * Process datatables ajax request.
     * @param string $pageUuid
     * @return mixed
     * @throws \Exception
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function dataTableIndex()
    {

        $payorder = $this->payorder->query();
        return Datatables::of($payorder)
            
            ->editColumn('status', function ($payorder) {
                if ($payorder->status == 1) {
                    $xhtml = '<span class="badge btn-xs badge-success">' . label('status_cart.success') . '</span>';
                } elseif($payorder->status == 2) {
                    $xhtml = '<span class="badge badge-danger">' . label('status_cart.cancel') . '</span>';
                }elseif($payorder->status == 3) {
                    $xhtml = '<span class="badge badge-primary">' . label('status_cart.delevery') . '</span>';
                }elseif($payorder->status == 4) {
                    $xhtml = '<span class="badge bg-warning text-dark">' . label('status_cart.status_disable') . '</span>';
                }else {
                    $xhtml = '<span class="badge badge-info">' . label('status_cart.success_delevery') . '</span>';
                }      
                return $xhtml;
            })
            ->addColumn('price',function($payorder)
            {
                return $this->paydetail->query()->where('payorder_id',$payorder->id)->sum('total');
            })
            ->addColumn('actions', function ($payorder) {
                return view('administrator.modules.cart.actions', ['uuid'    => $payorder->uuid, 'cart' => $this]);
            })
            ->rawColumns(['status', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
