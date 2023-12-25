<?php

namespace App\Http\Controllers\Administrator;

use App\Repositories\LogActivity\LogActivityRepository;
use Yajra\DataTables\DataTables;

class LogActivityController extends AdminController
{
    private $view = 'administrator.modules.activity.';

    private $module = 'module.activity';

    private $activity;

    /**
     * LogActivityController constructor.
     * @param LogActivityRepository $activity
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(LogActivityRepository $activity)
    {
        parent::__construct();
        $this->middleware('permission:activity_index', ['only' => ['index']]);

        $this->activity = $activity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function index()
    {
        return view($this->view . 'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function destroy(int $id)
    {
        $result = $this->activity->deleteById($id);

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
        $activity = $this->activity->getAllQuery();

        return Datatables::of($activity)
            ->editColumn('module', function ($news) {
                return module($news->module);
            })
            ->editColumn('created_at', function ($news) {
                return $news->created_at->format('d/m/Y  - h:i');
            })
            ->editColumn('action', function ($news) {
                return '<a href="' . $news->url . '">' . behavior('action.' . $news->action) . ' (' . $news->method . ')</a>';
            })
            ->addColumn('actions', 'administrator.modules.activity.actions')
            ->rawColumns(['action', 'actions'])
            ->addIndexColumn()
            ->make(true);
    }
}
