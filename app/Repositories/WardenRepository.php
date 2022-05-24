<?php

namespace App\Repositories;

use App\Models\Warden;
use App\Repositories\BaseRepository;

/**
 * Class WardenRepository
 * @package App\Repositories
 * @version April 28, 2022, 5:28 am UTC
*/

class WardenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'phone',
        'email_verified_at',
        'password',
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
        return Warden::class;
    }
}
