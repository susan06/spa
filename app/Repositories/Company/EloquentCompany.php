<?php

namespace App\Repositories\Company;

use App\Company;
use App\Repositories\Repository;

class EloquentCompany extends Repository implements CompanyRepository
{
	/**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name'];

    /**
     * EloquentCompany constructor
     *
     * @param Company $Company
     */
    public function __construct(Company $company)
    {
        parent::__construct($company);
    }


}