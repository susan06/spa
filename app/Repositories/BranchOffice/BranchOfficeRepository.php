<?php

namespace App\Repositories\BranchOffice;

use App\Repositories\RepositoryInterface;

interface BranchOfficeRepository extends RepositoryInterface
{
    /**
     * search 
     *
     *
     */
    public function search($take = 10, $request = null);

    /**
     * search by score
     *
     *
     */
    public function searchByScore($take = 10, $search = null);

    /**
     * get locales favorites
     *
     *
     */
    public function getLocalFavorites($take = 10, $client); 

    /**
     * store local in favorite
     *
     *
     */
    public function storeFavorite($id, $client);

    /**
     * delete local in favorite
     *
     *
     */
    public function deleteFavorite($id, $client); 

    /**
     * get locales visites
     *
     *
     */
    public function getLocalVisites($take = 10, $client); 

    /**
     * store local in visit
     *
     *
     */
    public function storeVisit($id, $client);

     /**
     * store vote of local
     *
     *
     */
    public function storeVote(array $data);

    /**
     * store recommendation of local
     *
     *
     */
    public function storeRecommend(array $data); 

    /**
     * count company
     *
     *
     */
    public function countCompany(); 

    /**
     * search by recommendation
     *
     */
    public function searchLocalVisitByCLient($take = 10, $client);

}