<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Pages
 * @package App\Models
 * @version November 15, 2021, 7:54 am UTC
 *
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $status
 */
class Pages extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'pages';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'slug',
        'description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'slug' => 'required|unique:pages',
        'description' => 'required',
    ];

    
}
