<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="AdTag",
 *      required={"ad_id", "tag_id"},
 *      @SWG\Property(
 *          property="ad_id",
 *          description="ad_id",
 *          type="integer",
 *          default=1,
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tag_id",
 *          description="tag_id",
 *          type="integer",
 *          default=1,
 *          format="int32"
 *      ),
 * )
 */
class AdTag extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'ad_tags';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'ad_id',
        'tag_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ad_id' => 'integer',
        'tag_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ad_id' => 'required|numeric',
        'tag_id' => 'required|numeric'
    ];

    
    public function Ad()
    {
       return $this->BelongsTo(Ad::class);
    }

    public function Tag()
    {
       return $this->BelongsTo(Tag::class);
    }
}
