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

}