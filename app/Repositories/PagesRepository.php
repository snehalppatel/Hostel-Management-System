<?php

namespace App\Repositories;

use App\Models\Pages;
use App\Repositories\BaseRepository;

/**
 * Class PagesRepository
 * @package App\Repositories
 * @version November 17, 2021, 6:26 am UTC
*/

class PagesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'slug',
        'description',
        'status'
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
        return Pages::class;
    }
}
