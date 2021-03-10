<?php

namespace App\Repositories;

use App\Models\Newsletter;
use App\Repositories\BaseRepository;

/**
 * Class NewsletterRepository
 * @package App\Repositories
 * @version March 10, 2021, 8:30 pm UTC
*/

class NewsletterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'email'
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
        return Newsletter::class;
    }
}
