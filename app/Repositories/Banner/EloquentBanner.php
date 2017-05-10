<?php

namespace App\Repositories\Banner;

use App\Banner;
use App\Repositories\Repository;

class EloquentBanner extends Repository implements BannerRepository
{
    /**
     * EloquentBanner constructor
     *
     * @param Banner $Banner
     */
    public function __construct(Banner $banner)
    {
        parent::__construct($banner);
    }

}