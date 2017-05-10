<?php

namespace App\Repositories\BranchOffice;

use App\Repositories\RepositoryInterface;

interface BranchOfficeRepository extends RepositoryInterface
{
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
    public function search($take = 10, $search = null);
}