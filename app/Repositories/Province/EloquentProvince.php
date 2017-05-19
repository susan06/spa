<?php

namespace App\Repositories\Province;

use App\Province;
use App\Repositories\Repository;

class EloquentProvince extends Repository implements ProvinceRepository
{
    /**
     * EloquentProvince constructor
     *
     * @param Province $Province
     */
    public function __construct(Province $province)
    {
        parent::__construct($province);
    }

}