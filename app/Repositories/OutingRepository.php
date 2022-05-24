<?php

namespace App\Repositories;

use App\Models\Outing;
use App\Repositories\BaseRepository;

/**
 * Class OutingRepository
 * @package App\Repositories
 * @version April 26, 2022, 1:06 pm UTC
*/

class OutingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'in_time',
        'out_time',
        'remarks'
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
        return Outing::class;
    }
}
