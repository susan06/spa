<?php

namespace App\Repositories\BranchOffice;

use App\BranchOffice;
use App\Score;
use App\Repositories\Repository;
use DB;

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
    public function searchByScore($take = 10, $search = null)
    {
        $query = Score::groupBy('branch_office_id');
        $query->selectRaw('*, avg(service) as avg_service, avg(service) as avg_service, avg(environment) as avg_environment, avg(attention) as avg_attention, avg(price) as avg_price, count(branch_office_id) as count_branch');

        $query->orderBy('avg_'.$search, 'DESC');

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * search by created_at or puntaje
     *
     *
     */
    public function search($take = 10, $search = null)
    {
        $query = Score::groupBy('branch_office_id');
        $query->selectRaw('*, avg(service) as avg_service, avg(service) as avg_service, avg(environment) as avg_environment, avg(attention) as avg_attention, avg(price) as avg_price, count(branch_office_id) as count_branch');

        if($new) {
            $query->orderBy('created_at', 'DESC');
        }

        $query->orderBy('avg_'.$search, 'DESC');

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

}