<?php

namespace App\Repositories;

use App\Models\AdTag;
use App\Repositories\BaseRepository;

/**
 * Class AdTagRepository
 * @package App\Repositories
 * @version November 5, 2021, 3:10 am UTC
*/

class AdTagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ad_id',
        'tag_id'
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
        return AdTag::class;
    }
}
