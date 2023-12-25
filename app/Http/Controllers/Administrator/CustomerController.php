<?php

namespace App\Http\Controllers\Administrator;

use App\Models\customer;
use App\Helpers\LogActivityHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Content\StoreRequest;
use App\Http\Requests\Administrator\Content\TranslationRequest;
use App\Http\Requests\Administrator\Content\UpdateRequest;
use App\Repositories\Customer\CustomerRepository;
use Composer\DependencyResolver\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;


class CustomerController extends Controller
{
    private $view = 'administrator.modules.customer.';

    private $route = 'admin.customer.';

    private $module = 'module.customer';

    private $customer;

    public function __construct(CustomerRepository $customer)
    {
        // parent::__construct();

        $this->middleware('permission:customer_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:customer_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer_destroy', ['only' => ['destroy']]);



        $this->customer = $customer;
    }

    public function index()
    {
        $data['customer'] = $this->customer->getAllCustomer();

        return view($this->view . 'index', $data);
    }

    public function create()
    {
        return view($this->view . 'create');
    }

    public function store(StoreRequest $request)
    {
        $customer = null;

        DB::transaction(function () use ($request, $customer) {
            $customer            = $request->only('name', 'image', 'content', 'open_link', 'link');
            $customer['status']  = $request->status ?? 'off';

            $customer = $this->customer->create($customer);
            Customer::flushQueryCache(['customer']);
            LogActivityHelper::addToLog([
                'module'      => 'customer',
                'action'      => 'create',
                'description' => $request->name
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('customer' => $customer)
            ],
            201
        );
    }

    public function show(string $uuid)
    {
        $data = $this->customer->getByUuid($uuid);

        return response()->json(
            [
                'status' => 'success',
                'result' => $data
            ], 200);
    }

    public function edit(string $uuid)
    {
        $data['customer'] = $this->customer->getByUuid($uuid);

        return view($this->view . 'edit', $data);
    }

    public function update(UpdateRequest $request, string $uuid)
    {
        $customer = null;

        DB::transaction(function () use ($request, $uuid, &$customer) {
            $customer            = $request->only('name', 'image', 'content', 'open_link', 'link');
            $customer['status']  = $request->status ?? 'off';

            Customer::flushQueryCache(['customer']);

            $customer = $this->customer->update($customer, $uuid);
        });



        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['customer' => $uuid]),
                'result'   => array('customer' => $customer)
            ],
            200
        );
    }

    public function destroy(string $uuid)
    {
        $data = $this->customer->getByUuid($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'customer',
            'action'      => 'delete',
            'description' => $data->name
        ]);

        $result = $this->customer->remove($uuid);
        Customer::flushQueryCache(['customer']);

        return response()->json(
            [
                'status'  => 'success',
                'message' => message_module($this->module, 'crud.destroy_success'),
                'result'  => $result
            ], 200);
    }

    /**
     * Process datatables ajax request.
     * @return mixed
     * @throws \Exception
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function dataTableIndex()
    {
        $customer = $this->customer->query();

        return Datatables::of($customer)
            ->editColumn('image', function($customer){
                if ($customer->image == NULL) {
                    return '<img height="100" width="200" src="' . asset(GLOBAL_ASSETS_IMG . 'avatar.svg') . '">';
                } else {
                    return '<img height="100" width="200" src="' . $customer->image . '">';
                }
            })

            ->editColumn('status', function ($customer) {
                if ($customer->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';
                }
                return $xhtml;
            })
            ->addColumn('actions', 'administrator.modules.customer.actions')
            ->rawColumns(['image', 'status', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
