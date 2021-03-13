<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Repositories\ContactRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Session;
use Response;

class ContactController extends AppBaseController
{
    /** @var  ContactRepository */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
    }

    /**
     * Display a listing of the Contact.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::where('have_read', false);

        if($request->has('view_read_messages'))
        {
            $contacts = Contact::where('have_read', true);
        }

        $contacts = $contacts->paginate(15);


        return view('admin.contacts.index')
            ->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create()
    {
//        return view('admin.contacts.create');
        return redirect()->back();
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param CreateContactRequest $request
     *
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $input = $request->all();

        $contact = $this->contactRepository->create($input);

        Flash::success('Contact saved successfully.');

        return redirect(route('admin.contacts.index'));
    }

    /**
     * Display the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('admin.contacts.index'));
        }

        return view('admin.contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('admin.contacts.index'));
        }

        return view('admin.contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified Contact in storage.
     *
     * @param int $id
     * @param UpdateContactRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactRequest $request)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('admin.contacts.index'));
        }

        $contact = $this->contactRepository->update($request->all(), $id);

        Flash::success('Contact updated successfully.');

        return redirect(route('admin.contacts.index'));
    }

    /**
     * Remove the specified Contact from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
//        $contact = $this->contactRepository->find($id);
//
//        if (empty($contact)) {
//            Flash::error('Contact not found');
//
//            return redirect(route('admin.contacts.index'));
//        }
//
//        $this->contactRepository->delete($id);
//
//        Flash::success('Contact deleted successfully.');
//
//        return redirect(route('admin.contacts.index'));
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function toggleField(Request $request): JsonResponse
    {
        if (Session::token() !== $request->get('_token') || !$request->ajax())
        {
            return response()->json( array(
                'status' => 'error',
                'msg' => 'Unauthorized access'
            ));
        }


        $fields = array("have_read");

        if (!$request->get("id") || !$request->get("field") || !in_array($request->get("field"), $fields))
        {
            return response()->json( array(
                'status' => 'error',
                'msg' => 'Invalid params'
            ));
        }


        $contact = Contact::find($request->id);

        if (empty($contact))
        {
            return response()->json( array(
                'status' => 'error',
                'msg' => 'Invalid data'
            ));
        }

        $f = $request->field;
        $contact->$f = ($request->status == 1 ? 1 : 0);
        $contact->save();

        return response()->json(array('status' => 'ok'));
    }
}
