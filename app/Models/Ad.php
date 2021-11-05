<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Ad",
 *      required={"type", "title", "description", "category_id", "user_id"},
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string",
 *          default="free",
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="category_id",
 *          description="category_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="start_at",
 *          description="start_at",
 *          type="string",
 *          format="date"
 *      ),
 * )
 */
class Ad extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'ads';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'title',
        'description',
        'category_id',
        'user_id',
        'start_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'category_id' => 'integer',
        'user_id' => 'integer',
        'start_at' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'title' => 'required',
        'description' => 'required',
        'category_id' => 'required|numeric',
        'user_id' => 'required|numeric'
    ];

    
    public function AdTags()
    {
       return $this->hasMany(AdTag::class);
    }

    public function Category()
    {
       return $this->BelongsTo(Category::class);
    }

    public function User()
    {
       return $this->BelongsTo(User::class);
    }
}
