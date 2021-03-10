<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

/**
 * Class Node
 * @package App\Models
 * @version March 10, 2021, 3:56 pm UTC
 *
 * @property integer $parent_id
 * @property string $name
 * @property string $slug
 * @property string $menu_name
 * @property string $canonical_url
 * @property string $short_description
 * @property string $content
 * @property integer $position
 * @property string $image
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property boolean $published
 * @property boolean $is_menu
 * @property boolean $is_sitemap
 * @property boolean $is_homepage
 * @property string $access_type
 * @property string $node_type
 * @property string $node_properties
 * @property string|\Carbon\Carbon $display_at
 * @property string|\Carbon\Carbon $ends_at
 *
 * @mixin Builder
 */
class Node extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'nodes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'menu_name' => 'string',
        'canonical_url' => 'string',
        'short_description' => 'string',
        'content' => 'string',
        'position' => 'integer',
        'image' => 'string',
        'meta_title' => 'string',
        'meta_description' => 'string',
        'meta_keywords' => 'string',
        'published' => 'boolean',
        'is_menu' => 'boolean',
        'is_sitemap' => 'boolean',
        'is_homepage' => 'boolean',
        'access_type' => 'string',
        'node_type' => 'string',
        'node_properties' => 'string',
        'display_at' => 'datetime',
        'ends_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'nullable',
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'menu_name' => 'nullable|string|max:255',
        'canonical_url' => 'nullable|string|max:255',
        'short_description' => 'nullable|string',
        'content' => 'nullable|string',
//        'position' => 'nullable|integer',
        'image' => 'nullable|string|max:255',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string|max:255',
        'published' => 'required|boolean',
        'is_menu' => 'required|boolean',
        'is_sitemap' => 'required|boolean',
        'is_homepage' => 'required|boolean',
        'access_type' => 'nullable|string',
        'node_type' => 'nullable|string|max:255',
        'node_properties' => 'nullable|string',
        'display_at' => 'nullable',
        'ends_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * Get the corespondent subnodes
     * @param bool $isMenu
     * @return
     */
    public function subnodes($isMenu = false)
    {
        $subnodes = $this->hasMany('App\Models\Node', "parent_id");
        $subnodes = Node::pageFilter($subnodes);

        if ($isMenu)
        {
            $subnodes = $subnodes->where("is_menu", 1)->get();
        }

        return $subnodes;
    }

    /**
     * @param Node $resource
     * @param bool $checkSitemap
     * @param bool $checkAdmin
     * @return mixed
     */
    static function pageFilter($resource, $checkSitemap = true, $checkAdmin = true)
    {
        if (!$checkAdmin || !Auth::user())
        {
            if ($checkSitemap)
            {
                $resource = $resource->where("is_sitemap", 1);
            }

//            $resource = $resource->where("published", 1)->where("display_at", "<", date("Y-m-d H:i:s"));
            $resource = $resource->where("published", 1);
        }

        return $resource;
    }

    /**
     * @param $propName
     * @return string
     */
    public function nodeProperty($propName)
    {
        return $this->property($propName);
    }

    /**
     *
     * @param $propName
     * @return string
     */
    public function property($propName)
    {
        if ($this->node_properties == "")
        {
            return "";
        }

        if ($this->propertiesObj == null)
        {
            $this->setPropertyObj();
        }

        return (isset($this->propertiesObj->$propName) ? $this->propertiesObj->$propName : "");
    }

    /**
     * @param $propName
     * @param $propValue
     */
    public function setNodeProperty($propName, $propValue)
    {
        $this->setProperty($propName, $propValue);
    }

    /**
     * @param $propName
     * @param $propValue
     */
    public function setProperty($propName, $propValue)
    {
        if ($this->node_properties == "")
        {
            $this->propertiesObj = (object)array();
        }
        else if ($this->propertiesObj == null)
        {
            $this->setPropertyObj();
        }

        $this->propertiesObj->$propName = $propValue;
        $this->node_properties = "";

        foreach ($this->propertiesObj as $pkey => $pval)
        {
            $this->node_properties .= ($this->node_properties != "" ? "&" : "") . "$pkey=$pval";
        }

        $this->save();
    }

    /**
     *
     */
    private function setPropertyObj(): void
    {
        $props = array();
        $elems = explode("&", $this->node_properties);
        foreach ($elems as $p)
        {
            list($key, $val) = explode("=", $p);
            $props[$key] = $val;
        }

        $this->propertiesObj = (object)$props;
    }


}
