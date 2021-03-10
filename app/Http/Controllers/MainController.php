<?php

namespace App\Http\Controllers;

use App\Helpers\NodeHelper;
use App\Models\Node;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MainController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = NodeHelper::getData();
        $node = Node::where('is_homepage', true)->first();
        $data['sections'] = $node->subnodes()->orderBy('position')->get();

        return view('main.index', $data);
    }

    /**
     * @param $nodePath
     * @param Request $request
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function showNode($nodePath, Request $request)
    {
        /** @var Node $node */
        $node = Node::where("slug", $nodePath)->first();

        $data = NodeHelper::getData();
        if ($node == null || !$node->published || !$node->is_sitemap)
        {
            $data["node"] = $data["parentNode"] = new Node();
            return Response::view("main.404", $data, 404);
        }


        if ($node->parent_id != 0)
        {
            $data["parentNode"] = $node->parent;
        }
        else
        {
            $data["parentNode"] = $node;
        }

        $data["node"] = $node;

        if ($node->property("template"))
        {
            $template = $node->property("template");

            $data["sections"] = Node::where("parent_id", $data["node"]->id)->where("published", 1)->orderBy("position")->get();

        }

        return view("main.". (isset($template) ? $template : "page"), $data);
    }
}
