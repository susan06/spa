<?php

namespace App\Repositories\Tour;

use App\TourReservation;
use App\Repositories\RepositoryInterface;

interface TourReservationRepository extends RepositoryInterface
{
    /**
     * search and paginate
     *
     *
     */
    public function search_paginate($take = 10, $owner = null, $tour = null, $search = null); 
}