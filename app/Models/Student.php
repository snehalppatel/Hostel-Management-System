<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Student
 * @package App\Models
 * @version September 25, 2021, 5:46 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $whatsapp_number
 * @property integer $pass_outyear
 * @property string $city
 * @property integer $pin
 */
class Student extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'users';
    

    // protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'phone',
        'first_name',
        'last_name',
        'roll_number',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'name' => 'string',
        // 'email' => 'string',
        // 'phone' => 'string',
        // 'whatsapp_number' => 'string',
        // 'pass_outyear' => 'integer',
        // 'city' => 'string',
        // 'pin' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'first_name' => 'required',
        // 'username' => ['required', 'string', 'max:255'],            
        // 'first_name' => ['required', 'string', 'max:255'],
        // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        // 'password' => ['required', 'string', 'min:6', 'confirmed'],        
       // 'phone' => 'required',
       // 'whatsapp_number' => 'required'
    ];

    
}
