<?php


namespace App\Helpers;


use App\Models\Node;

class NodeHelper
{
    /**
     * @return array
     */
    public static function getData()
    {
        $data = [];

        $data['menus'] = Node::where('is_menu', 1)->orderBy('position')->get();

        return $data;
    }
}
