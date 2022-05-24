<?php

namespace App\Models;

use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Leave
 * @package App\Models
 * @version April 26, 2022, 6:21 am UTC
 *
 * @property integer $user_id
 * @property string $start_date
 * @property string $end_date
 * @property string $reason
 */
class Leave extends Model
{
    use SoftDeletes;
    use Notifiable;    
    use HasFactory;

    public $table = 'leaves';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'reason',
        'status',
        'comment',
        'place',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'reason' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'start_date' => 'required',
        'end_date' => 'required'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function getStatusDisplayAttribute(){
        if($this->status == 'Pending'){
            return '<span class="badge badge-info">Pending</span>';
        }else if($this->status == 'Approved'){
            return '<span class="badge badge-success">Approved</span>';
        }else if($this->status == 'Rejected'){
            return '<span class="badge badge-danger">Rejected</span>';
        }else if($this->status == 'Pending'){
            return '<span class="badge badge-info">Pending</span>';
        }
    }   
}
