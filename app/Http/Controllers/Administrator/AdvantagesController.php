<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Advantages\StoreRequest;
use App\Repositories\Advantages\AdvantagesRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Advantages\UpdateRequest;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Builder;

class AdvantagesController extends Controller
{
    private $view = 'administrator.modules.advantages.';

    private $route = 'admin.advantages.';

    private $module = 'module.advantages';

    private $advantages;
    private $product;
    private $image;
    private $category;

    public function __construct(AdvantagesRepository $advantages, ProductRepository $product, CategoryRepository $category, ImageRepository $image)
    {
        // parent::__construct();

        $this->middleware('permission:advantages_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:advantages_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:advantages_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:advantages_destroy', ['only' => ['destroy']]);

        $this->product = $product;
        $this->category           = $category;
        $this->image = $image;
        $this->advantages = $advantages;
    }

    public function index()
    {
        $data['category'] = $this->category->getAllCategoryRecursive();
        $data['advantages'] = $this->advantages->getAll();
        $data['category_name'] = 'category';

        return view($this->view . 'index', $data);
    }

    public function create()
    {
        $data['category_name'] = 'category';
        $data['categories'] = $this->category->getAll();

        $data['root_position_max'] = $this->image->getMaxPosition(1);

        return view($this->view . 'create', $data);
    }

    public function store(StoreRequest $request)
    {
        $advantages = null;

        DB::transaction(function () use ($request, $advantages) {
            $advantages            = $request->only('name','title',  'subcontent','image', 'content', 'category_id', 'position');
            $advantages['status']  = $request->status ?? 'off';
            // dd($advantages);

            $advantages = $this->advantages->create($advantages);

            LogActivityHelper::addToLog([
                'module'      => 'advantages',
                'action'      => 'create',
                'description' => $request->name
            ]);
        });

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('advantages' => $advantages)
            ],
            201
        );
    }

    public function show(string $uuid)
    {
        $data = $this->advantages->getByUuid($uuid);

        return response()->json(
            [
                'status' => 'success',
                'result' => $data
            ], 200);
    }

    public function edit(string $uuid)
    {
        $data['category_name'] = 'category';
        $data['categories'] = $this->category->getAll();
        $data['advantages'] = $this->advantages->getByUuid($uuid);


        return view($this->view . 'edit', $data);
    }

    public function update(UpdateRequest $request, string $uuid)
    {
        $advantages = null;

        DB::transaction(function () use ($request, $uuid, &$advantages) {
            $advantages            = $request->only('name','title', 'image', 'content', 'subcontent', 'category_id', 'position');
            $advantages['status']  = $request->status ?? 'off';


            $advantages = $this->advantages->update($advantages, $uuid);

            // $advantages->category()->sync($request->category_id);

        });



        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['advantage' => $uuid]),
                'result'   => array('advantages' => $advantages)
            ],
            200
        );
    }

    public function destroy(string $uuid)
    {
        $data = $this->advantages->getByUuid($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'advantages',
            'action'      => 'delete',
            'description' => $data->name
        ]);

        $result = $this->advantages->remove($uuid);

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
        $advantages = $this->advantages->query();

        return Datatables::of($advantages)
            ->editColumn('title', function($advantages){
                return $advantages->title;
            })

            ->editColumn('image', function($advantages){
                if ($advantages->image == NULL) {
                    return '<img height="100" width="200" src="' . asset(GLOBAL_ASSETS_IMG . 'avatar.svg') . '">';
                } else {
                    return '<img height="100" width="200" src="' . $advantages->image . '">';
                }
            })
            ->editColumn('category_id', function ($advantages) {
                return $advantages->category->name;
            })

            ->filterColumn('category', function (Builder $query, $keyword) {
                $query->whereHas('category', function (Builder $query) use ($keyword) {
                    $query->where('categories.id', $keyword);
                });
            })

            ->editColumn('status', function ($advantages) {
                if ($advantages->status == 'on') {
                    $xhtml = '<span class="badge btn-xs badge-info">' . label('element.status_enable') . '</span>';
                } else {
                    $xhtml = '<span class="badge badge-secondary">' . label('element.status_disable') . '</span>';
                }
                return $xhtml;
            })
            ->addColumn('actions', 'administrator.modules.advantages.actions')
            ->rawColumns(['image', 'status', 'actions', 'title'])
            ->addIndexColumn()
            ->make(true);
    }
}
