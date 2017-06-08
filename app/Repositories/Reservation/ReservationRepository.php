<?php

namespace App\Repositories\Reservation;

use App\Reservation;
use App\Repositories\RepositoryInterface;

interface ReservationRepository extends RepositoryInterface
{
    /**
     * search and paginate
     *
     *
     */
    public function search_paginate($take = 10, $owner = null, $branch = null,  $date = null, $search = null); 
}