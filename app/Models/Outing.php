<?php

namespace App\Models;

use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Outing
 * @package App\Models
 * @version April 26, 2022, 1:06 pm UTC
 *
 * @property integer $user_id
 * @property time $in_time
 * @property time $out_time
 * @property string $remarks
 */
class Outing extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'outings';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'in_time',
        'out_time',
        'remarks',
        'in_date',
        'out_date',
        'roll_number',
        'security_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'remarks' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'in_time' => 'required',
        // 'out_time' => 'required'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
