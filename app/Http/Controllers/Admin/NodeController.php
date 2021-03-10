<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateNodeRequest;
use App\Http\Requests\UpdateNodeRequest;
use App\Models\Node;
use App\Repositories\NodeRepository;
use App\Http\Controllers\AppBaseController;
use App\Traits\ImageUpload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Str;
use Response;

class NodeController extends AppBaseController
{
    use ImageUpload;

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
//        $nodes = $this->nodeRepository->all();
        if($request->has('parent'))
        {
            $nodes = Node::where('parent_id', $request->get('parent'))->get();
        }
        else
        {
            $nodes = Node::where('parent_id', null)->get();
        }

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
        $inputs = $this->handleImagesUpload($request, 'image');

        $node = $this->nodeRepository->create($inputs);

        Flash::success('Node saved successfully.');

        return redirect(route('admin.nodes.index', ['parent' => $node->parent_id]));
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
    public function update(int $id, UpdateNodeRequest $request)
    {
        $node = $this->nodeRepository->find($id);

        if (empty($node)) {
            Flash::error('Node not found');

            return redirect(route('admin.nodes.index'));
        }

        $inputs = $this->handleImagesUpload($request, 'image');

        $node = $this->nodeRepository->update($inputs, $id);

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

    /**
     * @param Request $request
     * @param $field
     * @return array
     */
    private function handleImagesUpload(Request $request, $field) : array
    {
        $inputs = $request->all();

        if ($request->hasFile($field))
        {
            $filePath = $this->NodeImageUpload($request->file($field));

            $inputs[$field] = $filePath;
        }

        return $inputs;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function generateSlug(Request $request)
    {
        if ($request->get("parent_id"))
        {
            $parent = Node::findOrFail($request->get("parent_id"));
        }

        $slug = (isset($parent) && !empty($parent->slug) ? $parent->slug. "/" : ""). Str::slug($request->get("name"));

        $dupNode = Node::where("slug", $slug);
        if ($request->get("id"))
        {
            $node = Node::findOrFail($request->get("id"));
            $dupNode = $dupNode->where("id", "!=", $node->id);
        }

        $dupNode = $dupNode->first();

        $response = array('status' => 'ok', 'slug' => $slug);

        if ($dupNode != null) // there is a duplicate node with the same slug
        {
            $response["status"] = "error";
            $response["message"] = trans("There is already a node with that slug");

            $cnt = 0;
            while ($dupNode != null)
            {
                $cnt++;
                $dupNode = Node::where("slug", $slug. "-$cnt");
                if (isset($node))
                {
                    $dupNode = $dupNode->where("id", "!=", $node->id);
                }

                $dupNode = $dupNode->first();
            }

            $slug .= "-$cnt";
            $response["slug"] = $slug;
        }

        return response()->json($response);
    }
}
