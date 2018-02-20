<?php

namespace App\Repositories\Tour;

use App\TourReservation;
use App\Repositories\Repository;

class EloquentTourReservation extends Repository implements TourReservationRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [
        'details_client',
    ];

    /**
     * EloquentRole constructor
     *
     * @param Tour $Tour
     */
    public function __construct(TourReservation $tourReservation)
    {
        parent::__construct($tourReservation, $this->attributes);
    }

    /**
     * search and paginate
     *
     *
     */
    public function search_paginate($take = 10, $owner = null, $tour = null, $search = null) 
    {
        $query = Tour::query(); 

        $query->select('tours_reservations.*');

        if ($owner) {
            $query->join('tours', 'tours_reservations.tour_id', '=', 'tours.id');
            $query->join('branch_offices', 'tours.branch_office_id', '=', 'branch_offices.id');
            $query->join('companies', 'branch_offices.company_id', '=', 'companies.id');
            $query->where('companies.owner_id', $owner);
        }

        if ($tour) {
            $query->where('tour_id', $branch);
        }

        if ($search) {
            $searchTerms = explode(' ', $search);
            $query->where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                    foreach ($this->attributes as $attribute) {
                        $q->orwhere($attribute, "like", "%{$term}%");
                    }
                   
                }
            });
        }

        $result = $query->paginate($take);

        if ($tour) {
            $result->appends(['tour' => $tour]);
        }

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }


}