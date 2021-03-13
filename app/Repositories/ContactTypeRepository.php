<?php

namespace App\Repositories;

use App\Models\ContactType;
use App\Repositories\BaseRepository;

/**
 * Class ContactTypeRepository
 * @package App\Repositories
 * @version March 13, 2021, 10:30 am UTC
*/

class ContactTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'active'
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
        return ContactType::class;
    }
}
