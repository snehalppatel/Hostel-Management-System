<?php

namespace App\Repositories;

use App\Models\Courier;
use App\Repositories\BaseRepository;

/**
 * Class CourierRepository
 * @package App\Repositories
 * @version April 26, 2022, 1:33 pm UTC
*/

class CourierRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'roll_number',
        'date',
        'security_id',
        'hostel_name'
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
        return Courier::class;
    }
}
