<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Warden
 * @package App\Models
 * @version April 28, 2022, 5:28 am UTC
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email_verified_at
 * @property string $password
 * @property string $email
 */
class Warden extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'wardens';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email_verified_at',
        'password',
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'phone' => 'string',
        'email_verified_at' => 'date',
        'password' => 'string',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'reqired',
        'last_name' => 'required',
        'password' => 'remember_token string text',
        'email' => 'required'
    ];

    
}
