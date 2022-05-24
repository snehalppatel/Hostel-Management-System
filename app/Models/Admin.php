<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class Admin
 * @package App\Models
 * @version April 26, 2022, 3:49 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $password
 */
class Admin extends Authenticatable
{
    use SoftDeletes;
     use Notifiable;
    use HasFactory;

    public $table = 'admins';
    
    protected $guard = 'admin';
    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required'
    ];

    
}
