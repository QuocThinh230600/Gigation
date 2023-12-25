<?php

namespace App\Http\Controllers\Administrator;

use App\Helpers\LogActivityHelper;
use App\Http\Requests\Administrator\ReplyContact\SendReplyRequest;
use App\Models\ReplyContact as ModelsContact;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\ReplyContact\ReplyContactRepository;
use Yajra\DataTables\DataTables;

class ReplyContactController extends AdminController
{
    private $view = 'administrator.modules.contact.';

    private $route = 'admin.contact.';

    private $module = 'module.contact';

    private $contact;

    private $replyContact;

    /**
     * ReplyContactController constructor.
     * @param ContactRepository $contact
     * @param ReplyContactRepository $replyContact
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function __construct(ContactRepository $contact,
                                ReplyContactRepository $replyContact)
    {
        parent::__construct();
        $this->middleware('permission:contact_index', ['only' => ['index']]);
        $this->middleware('permission:contact_reply', ['only' => ['reply', 'send_reply']]);
        $this->middleware('permission:contact_destroy', ['only' => ['destroy']]);

        $this->contact      = $contact;
        $this->replyContact = $replyContact;
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
     * Display a view to reply message from client.
     *
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function reply(string $uuid)
    {
        $data['contact'] = $this->contact->getByUuid($uuid);

        $contact_id      = $this->contact->getIdByUuid($uuid);
        $data['replies'] = $this->replyContact->getAllReplyOfContact($contact_id);

        if (count($data['replies']) <= 0) {
            $data["selected_status"] = 1;
        } else {
            $data["selected_status"] = $data['replies']->last()->status;
        }

        return view($this->view . 'reply', $data);
    }

    /**
     * Reply message from client.
     *
     * @param SendReplyRequest $request
     * @param string $uuid
     * @return mixed
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function send_reply(SendReplyRequest $request, string $uuid)
    {
        $data               = $request->except('_token', 'method');
        $data['user_id']    = auth()->user()->id;
        $data['contact_id'] = $this->contact->getIdByUuid($uuid);
        $contact            = $this->replyContact->create($data);

        ModelsContact::flushQueryCache(['reply_contacts']);

        LogActivityHelper::addToLog([
            'module'      => 'contact',
            'action'      => 'reply',
            'description' => $request->reply
        ]);

        return response()->json(
            [
                'status'   => 'success',
                'message'  => message('contact.reply'),
                'redirect' => route($this->route . 'reply', ['contact' => $uuid]),
                'result'   => array('contact' => $contact)
            ], 201);
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
        $data = $this->contact->getByUuid($uuid);

        LogActivityHelper::addToLog([
            'module'      => 'contact',
            'action'      => 'reply',
            'description' => $data->message
        ]);

        $result = $this->contact->remove($uuid);
        ModelsContact::flushQueryCache(['reply_contacts']);

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
        $contact = $this->contact->getAllContactWithReply();

        return Datatables::of($contact)
            ->editColumn('status', function ($contact) {
                $xhtml = null;
                if (count($contact->reply_contact) <= 0) {
                    $xhtml = label('status_contact.not_contacted');
                } else {
                    $status = $contact->reply_contact->last()->status;
                    foreach (status_contact() as $status_code) {
                        if ($status_code->id == $status) {
                            $xhtml = $status_code->name;
                        }
                    }
                }

                return $xhtml;
            })
            ->addColumn('actions', function ($image) {
                return view('administrator.modules.contact.actions', ['uuid' => $image->uuid]);
            })
            ->rawColumns(['actions', 'status'])
            ->addIndexColumn()
            ->make(true);
    }
}
