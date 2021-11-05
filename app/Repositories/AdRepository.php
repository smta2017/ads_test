<?php

namespace App\Repositories;

use App\Models\Ad;
use App\Repositories\BaseRepository;
use App\Repositories\I\IAd;

/**
 * Class AdRepository
 * @package App\Repositories
 * @version November 5, 2021, 2:38 am UTC
 */

class AdRepository extends BaseRepository implements IAd
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'title',
        'description',
        'category_id',
        'user_id',
        'start_at'
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
        return Ad::class;
    }

    public function adFilterByCategoryAndTag($category_id, $tag_id)
    {
        $query = $this->model->newQuery();

        return  $query->where('category_id', $category_id)
            ->whereHas('AdTags', function ($q) use ($tag_id) {
                $q->where('tag_id', $tag_id);
            })
            ->get();
    }
}
