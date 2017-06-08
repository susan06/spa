<?php

namespace App\Repositories\Reservation;

use App\Reservation;
use App\Repositories\Repository;

class EloquentReservation extends Repository implements ReservationRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [
        'date',
        'hour',
        'details_client',
    ];

    /**
     * EloquentRole constructor
     *
     * @param Reservation $Reservation
     */
    public function __construct(Reservation $reservation)
    {
        parent::__construct($reservation, $this->attributes);
    }

    /**
     * search and paginate
     *
     *
     */
    public function search_paginate($take = 10, $owner = null, $branch = null,  $date = null, $search = null) 
    {
        $query = Reservation::query(); 

        $query->select('reservations.*');

        if ($owner) {
            $query->join('branch_offices', 'reservations.branch_office_id', '=', 'branch_offices.id');
            $query->join('companies', 'branch_offices.company_id', '=', 'companies.id');
            $query->where('companies.owner_id', $owner);
        }

        if ($branch) {
            $query->where('branch_office_id', $branch);
        }

        if($date) {
            $query->where('date', "like", "%{$date}%");
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

        if ($branch) {
            $result->appends(['branch' => $branch]);
        }

        if ($date) {
            $result->appends(['date' => $date]);
        }

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }


}