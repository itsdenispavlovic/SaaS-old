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

        $data['footer'] = Node::where('node_properties', 'entity=footer')->first();

        $companyLinks = Node::where('node_properties', 'entity=footer.company_links')->first();
        $usefulLinks = Node::where('node_properties', 'entity=footer.useful_links')->first();
        $legalLinks = Node::where('node_properties', 'entity=footer.legal_links')->first();

        $data['footer']['company_links'] = $companyLinks->subnodes()->orderBy('position')->get();
        $data['footer']['useful_links'] = $usefulLinks->subnodes()->orderBy('position')->get();
        $data['footer']['legal_links'] = $legalLinks->subnodes()->orderBy('position')->get();

        return $data;
    }
}
