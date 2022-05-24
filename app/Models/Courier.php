<?php

namespace App\Models;

use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Courier
 * @package App\Models
 * @version April 26, 2022, 1:33 pm UTC
 *
 * @property string $name
 * @property string $roll_number
 * @property string $date
 * @property integer $security_id
 * @property string $hostel_name
 */
class Courier extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'couriers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'roll_number',
        'date',
        'security_id',
        'hostel_name',
        'order_type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'roll_number' => 'string',
        'date' => 'date',
        'security_id' => 'integer',
        'hostel_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'roll_number' => 'required'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'roll_number', 'roll_number');
    }
    
}