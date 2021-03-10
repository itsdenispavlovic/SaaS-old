<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateNodeRequest;
use App\Http\Requests\UpdateNodeRequest;
use App\Repositories\NodeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class NodeController extends AppBaseController
{
    /** @var  NodeRepository */
    private $nodeRepository;

    public function __construct(NodeRepository $nodeRepo)
    {
        $this->nodeRepository = $nodeRepo;
    }

    /**
     * Display a listing of the Node.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $nodes = $this->nodeRepository->all();

        return view('admin.nodes.index')
            ->with('nodes', $nodes);
    }

    /**
     * Show the form for creating a new Node.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.nodes.create');
    }

    /**
     * Store a newly created Node in storage.
     *
     * @param CreateNodeRequest $request
     *
     * @return Response
     */
    public function store(CreateNodeRequest $request)
    {
        $input = $request->all();

        $node = $this->nodeRepository->create($input);

        Flash::success('Node saved successfully.');

        return redirect(route('admin.nodes.index'));
    }

    /**
     * Display the specified Node.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $node = $this->nodeRepository->find($id);

        if (empty($node)) {
            Flash::error('Node not found');

            return redirect(route('admin.nodes.index'));
        }

        return view('admin.nodes.show')->with('node', $node);
    }

    /**
     * Show the form for editing the specified Node.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $node = $this->nodeRepository->find($id);

        if (empty($node)) {
            Flash::error('Node not found');

            return redirect(route('admin.nodes.index'));
        }

        return view('admin.nodes.edit')->with('node', $node);
    }

    /**
     * Update the specified Node in storage.
     *
     * @param int $id
     * @param UpdateNodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNodeRequest $request)
    {
        $node = $this->nodeRepository->find($id);

        if (empty($node)) {
            Flash::error('Node not found');

            return redirect(route('admin.nodes.index'));
        }

        $node = $this->nodeRepository->update($request->all(), $id);

        Flash::success('Node updated successfully.');

        return redirect(route('admin.nodes.index'));
    }

    /**
     * Remove the specified Node from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $node = $this->nodeRepository->find($id);

        if (empty($node)) {
            Flash::error('Node not found');

            return redirect(route('admin.nodes.index'));
        }

        $this->nodeRepository->delete($id);

        Flash::success('Node deleted successfully.');

        return redirect(route('admin.nodes.index'));
    }
}
