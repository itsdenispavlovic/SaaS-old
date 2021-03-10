<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $node = Node::where('is_homepage', true)->first();
        $sections = $node->subnodes()->orderBy('position')->get();

        return view('main.index', compact('sections'));
    }
}
