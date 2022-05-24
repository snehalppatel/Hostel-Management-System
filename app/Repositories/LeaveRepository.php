<?php

namespace App\Repositories;

use App\Models\Leave;
use App\Repositories\BaseRepository;

/**
 * Class LeaveRepository
 * @package App\Repositories
 * @version April 26, 2022, 6:21 am UTC
*/

class LeaveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'start_date',
        'end_date',
        'reason'
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
        return Leave::class;
    }
}
