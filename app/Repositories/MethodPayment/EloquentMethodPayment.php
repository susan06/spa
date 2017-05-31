<?php

namespace App\Repositories\MethodPayment;

use App\MethodPayment;
use App\Repositories\Repository;

class EloquentMethodPayment extends Repository implements MethodPaymentRepository
{
	/**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name'];

    /**
     * EloquentMethodPayment constructor
     *
     * @param MethodPayment $MethodPayment
     */
    public function __construct(MethodPayment $methodPayment)
    {
        parent::__construct($methodPayment);
    }


}