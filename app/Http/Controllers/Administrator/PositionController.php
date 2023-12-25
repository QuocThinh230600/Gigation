<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\Position\StoreRequest;
use App\Http\Requests\Administrator\Position\UpdateRequest;
use App\Http\Resources\Position;
use App\Models\Position as ModelsPosition;
use App\Repositories\Position\PositionRepository;
use Illuminate\Http\Request as RequestAjax;
use Illuminate\Support\Facades\Request;

class PositionController extends AdminController
{
    private $route = 'admin.position.';

    private $view = 'administrator.modules.position.';

    private $module = 'module.position';

    private $position;

    /**
     * PositionController constructor.
     * @param PositionRepository $position
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(PositionRepository $position)
    {
        parent::__construct();
        $this->middleware('permission:role_index', ['only' => ['show', 'index', 'dataTableIndex']]);
        $this->middleware('permission:role_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role_destroy', ['only' => ['destroy']]);

        $this->position = $position;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        $data['positions'] = $this->position->getAllPositionRecursive();

        if (Request::is('api*')) {
            return new Position($data['categories']);
        }

        return view($this->view . 'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function create()
    {
        $data['root_position_max'] = $this->position->getMaxPosition(1);
        $data['parent']            = $this->position->getAllPositionRecursive();

        return view($this->view . 'create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function store(StoreRequest $request)
    {
        $position            = $request->except('_token', '_method');
        $position['status']  = $request->status ?? 'off';
        $position['access']  = implode(",", $request->access);
        $position['user_id'] = auth()->user()->id;
        $position            = $this->position->create($position);

        ModelsPosition::flushQueryCache(['positions']);

        LogActivityHelper::addToLog([
            'module'      => 'position',
            'action'      => 'create',
            'description' => $request->name,
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.create_success'),
                'redirect' => route($this->route . 'create'),
                'result'   => array('position' => $position)
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function show(string $uuid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function edit(string $uuid)
    {
        $data['position'] = $this->position->getByUuid($uuid);

        $id             = $this->position->getIdByUuid($uuid);
        $data['parent'] = $this->position->getAllPositionRecursiveToUpdate($id);

        return view($this->view . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function update(UpdateRequest $request, string $uuid)
    {
        $position            = $request->except('_token', '_method');
        $position['status']  = $request->status ?? 'off';
        $position['access']  = implode(",", $request->access);
        $position['user_id'] = auth()->user()->id;
        $position            = $this->position->update($position, $uuid);

        ModelsPosition::flushQueryCache(['positions']);
        
        LogActivityHelper::addToLog([
            'module'      => 'position',
            'action'      => 'edit',
            'description' => $request->name,
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message_module($this->module, 'crud.edit_success'),
                'redirect' => route($this->route . 'edit', ['position' => $uuid]),
                'result'   => array('position' => $position)
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function destroy(string $uuid)
    {
        if ($this->position->countChildToDelete($uuid)) {
            $data = $this->position->getByUuid($uuid);

            LogActivityHelper::addToLog([
                'module'      => 'position',
                'action'      => 'delete',
                'description' => $data->name,
            ]);

            $result = $this->position->remove($uuid);

            return response()->json(
                [
                    'status'  => 'success',
                    'message' => message_module($this->module, 'crud.destroy_success'),
                    'result'  => $result
                ], 200);
        } else {
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => message_module($this->module, 'position.position_not_exist_child'),
                ], 200);
        }
    }

    /**
     * Get position max of category after change parent category
     * @param RequestAjax $request
     * @return int
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function ajaxSelectPosition(RequestAjax $request): int
    {
        return $this->position->getMaxPosition($request->id);
    }

    /**
     * Get position of category
     * @param RequestAjax $request
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function ajaxTablePosition(RequestAjax $request)
    {
        $id       = $request->id;
        $position = ($request->position <= 0) ? 1 : $request->position;

        $this->position->updatePositionTable($id, $position);

        return response()->json(
            [
                'status'  => 'success',
                'message' => message('ajax.table_category_position')
            ], 200);
    }
}
