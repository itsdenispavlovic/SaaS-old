<?php

namespace App\Repositories;

use App\Models\Node;
use App\Repositories\BaseRepository;

/**
 * Class NodeRepository
 * @package App\Repositories
 * @version March 10, 2021, 3:56 pm UTC
*/

class NodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'name',
        'slug',
        'menu_name',
        'canonical_url',
        'short_description',
        'content',
        'position',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published',
        'is_menu',
        'is_sitemap',
        'is_homepage',
        'access_type',
        'node_type',
        'node_properties',
        'display_at',
        'ends_at'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Node::class;
    }
}
