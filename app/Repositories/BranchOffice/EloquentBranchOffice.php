<?php

namespace App\Repositories\BranchOffice;

use App\BranchOffice;
use App\Score;
use App\Favorite;
use App\Visit;
use App\Recommendation;
use App\Company;
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
     * search 
     *
     *
     */
    public function search($take = 10, $request = nulll) 
    {
        $result = [];

        if ($request && $request->all()) {

            if ($request->get('reservation_web')) {
                
                $result = $this->model->where('reservation_web', true)->paginate(10);
                $result->appends(['reservation_web' => true]);
            }

            if ($request->get('recommendation')) {
                
                $result = $this->searchByRecommendation($take);
                $result->appends(['recommendation' => true]);
            }

            if ($request->get('score')) {
                $result = $this->searchByScore(10, $request->get('score'));
            }

            $result->appends(['search' => true]);

        } 

        return $result;
    }

    /**
     * search by recommendation
     *
     */
    private function searchByRecommendation($take = 10)
    {
        $query = Recommendation::groupBy('branch_office_id');
        $query->selectRaw('*, count(branch_office_id) as count_branch');

        $query->orderBy('count_branch', 'DESC');

        $result = $query->paginate($take);

        return $result;
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
            $result->appends(['score' => $search]);
        }

        return $result;
    }

    /**
     * get locales favorites
     *
     *
     */
    public function getLocalFavorites($take = 10, $client) 
    {
        return Favorite::where('client_id', $client)->paginate($take);
    }

    /**
     * store local in favorite
     *
     *
     */
    public function storeFavorite($id, $client) 
    {
        return Favorite::create([
            'branch_office_id' => $id,
            'client_id' => $client
        ]);
    }

    /**
     * delete local in favorite
     *
     *
     */
    public function deleteFavorite($id, $client) 
    {
        $favorite = Favorite::where('client_id', $client)->where('branch_office_id', $id)->first();

        return $favorite->delete();
    }

    /**
     * get locales visites
     *
     *
     */
    public function getLocalVisites($take = 10, $client) 
    {
        return Visit::where('client_id', $client)->paginate($take);
    }

    /**
     * store local in visit
     *
     *
     */
    public function storeVisit($id, $client) 
    {
        return Visit::create([
            'branch_office_id' => $id,
            'client_id' => $client
        ]);
    }

    /**
     * store vote of local
     *
     *
     */
    public function storeVote(array $data) 
    {
        return Score::create($data);
    }

    /**
     * store recommendation of local
     *
     *
     */
    public function storeRecommend(array $data) 
    {
        return Recommendation::firstOrCreate($data);
    }

    /**
     * count company
     *
     *
     */
    public function countCompany()
    {
        return Company::count();
    } 


    /**
     * search by recommendation
     *
     */
    public function searchLocalVisitByCLient($take = 10, $client)
    {
        $query = Visit::where('client_id', $client);
        $query->groupBy('branch_office_id');
        $query->selectRaw('*, count(branch_office_id) as count_branch');

        $query->orderBy('count_branch', 'DESC');

        $result = $query->paginate($take);

        return $result;
    }

}
