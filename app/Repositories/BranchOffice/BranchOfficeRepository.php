<?php

namespace App\Repositories\BranchOffice;

use App\Repositories\RepositoryInterface;

interface BranchOfficeRepository extends RepositoryInterface
{
    /**
     * search by score
     *
     *
     */
    public function searchByScore($take = 10, $search = null);

    /**
     * search by created_at or puntaje
     *
     *
     */
    public function search($take = 10, $search = null);
}