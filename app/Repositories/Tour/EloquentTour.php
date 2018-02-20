<?php

namespace App\Repositories\Tour;

use App\Tour;
use App\Repositories\Repository;

class EloquentTour extends Repository implements TourRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [
        'title',
        'date_start',
        'date_end',
        'description',
    ];

    /**
     * EloquentRole constructor
     *
     * @param Tour $Tour
     */
    public function __construct(Tour $tour)
    {
        parent::__construct($tour, $this->attributes);
    }

    /**
     * search and paginate
     *
     *
     */
    public function search_paginate($take = 10, $owner = null, $branch = null, $search = null) 
    {
        $query = Tour::query(); 

        $query->select('tours.*');

        if ($owner) {
            $query->join('branch_offices', 'tours.branch_office_id', '=', 'branch_offices.id');
            $query->join('companies', 'branch_offices.company_id', '=', 'companies.id');
            $query->where('companies.owner_id', $owner);
        }

        if ($branch) {
            $query->where('branch_office_id', $branch);
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

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }


}