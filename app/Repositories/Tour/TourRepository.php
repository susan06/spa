<?php

namespace App\Repositories\Tour;

use App\Tour;
use App\Repositories\RepositoryInterface;

interface TourRepository extends RepositoryInterface
{
    /**
     * search and paginate
     *
     *
     */
    public function search_paginate($take = 10, $owner = null, $branch = null, $search = null); 
}