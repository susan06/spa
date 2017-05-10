<?php

namespace App\Repositories\BranchOffice;

use App\BranchOffice;
use App\Score;
use App\Repositories\Repository;

class EloquentBranchOffice extends Repository implements BranchOfficeRepository
{
    /**
     * EloquentBrachOffice constructor
     *
     * @param BrachOffice $BrachOffice
     */
    public function __construct(BranchOffice $branchOffice)
    {
        parent::__construct($branchOffice);
    }

    /**
     * Paginate and search
     *
     * return the result paginated for the take value and with the attributes.
     *
     * @param int $take
     * @param string $search
     *
     *
     */
    public function search($take = 10, $search = null)
    {
        $query = Score::query();

        if ($search) {
            $query->orderBy($search, 'desc');
        }

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

}