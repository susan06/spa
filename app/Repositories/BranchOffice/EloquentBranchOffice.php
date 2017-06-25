<?php

namespace App\Repositories\BranchOffice;

use App\BranchOffice;
use App\Score;
use App\Favorite;
use App\Visit;
use App\Recommendation;
use App\Company;
use App\Payment;
use App\Photo;
use App\Service;
use App\Repositories\Repository;
use DB;

class EloquentBranchOffice extends Repository implements BranchOfficeRepository
{
     /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [
        'name',
        'address'
    ];

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
    public function search($take = 10, $request = null) 
    {
        $result = [];

        if ($request && $request->all()) {

            if ($request->get('reservation_web')) {
                
                $result = $this->model->where('status', true)->where('reservation_web', true)->paginate(10);
                $result->appends(['reservation_web' => true]);
            }

            if ($request->get('province_id')) {
                
                $result = $this->model->where('status', true)->where('province_id', $request->get('province_id'))->paginate(10);
                $result->appends(['province_id' => true]);
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
     * search 
     *
     *
     */
    public function branchByOwner($take = 10, $owner = null, $branch = null, $search = null) 
    {
        if ($branch) {
            $query = BranchOffice::where('id', $branch);
        } else {
           $query = BranchOffice::query(); 
        }

        if ($owner) {
            $query->whereHas(
                'company', function($q) use ($owner) {
                    $q->where('owner_id', $owner);
                }
            );
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

    /**
     * search by recommendation
     *
     */
    private function searchByRecommendation($take = 10)
    {
        $query = Recommendation::groupBy('branch_office_id');
        $query->join('branch_offices', 'recommendations.branch_office_id', '=', 'branch_offices.id');
        $query->selectRaw('recommendations.*, count(recommendations.branch_office_id) as count_branch');

        $query->where('branch_offices.status', true);
        $query->orderBy('count_branch', 'DESC');

        $result = $query->paginate($take);

        return $result;

    }


    public function listScore($take = 10, $branch)
    {
        $result = Score::where('branch_office_id', $branch)->paginate($take);

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
        $query = Score::groupBy('scores.branch_office_id');
        $query->join('branch_offices', 'scores.branch_office_id', '=', 'branch_offices.id');
        $query->selectRaw('scores.*, avg(scores.service) as avg_service, avg(scores.service) as avg_service, avg(scores.environment) as avg_environment, avg(scores.attention) as avg_attention, avg(scores.price) as avg_price, count(scores.branch_office_id) as count_branch');

        $query->where('branch_offices.status', true);
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
    public function countCompany($owner_id = null)
    {
        if($owner_id) {
            $count = Company::where('owner_id', $owner_id)->count();
        } else {
            $count = Company::count();
        }

        return $count;
    } 

    /**
     * count branch by owner
     *
     *
     */
    public function countByOwner($owner_id = null)
    {
        $companies = Company::where('owner_id', $owner_id)->with('branchs')->get();
        $count = 0;

        foreach ($companies as $key => $company) {
            $count += $company->branchs->count();
        }

        return $count;
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

    public function create_service(array $data) 
    {
        return Service::create($data);
    }

    public function update_service($id, array $data) 
    {
        return Service::where('id', $id)->update($data);
    }

    public function delete_service($id)
    {
        Service::destroy($id);
    }

    public function create_payment(array $data) 
    {
        return Payment::firstOrCreate($data);
    }

    public function delete_payment($id)
    {
        Payment::destroy($id);
    }

    public function create_photo(array $data) 
    {
        return Photo::create($data);
    }

    public function delete_photo($id)
    {
        Photo::destroy($id);
    }


    public function branchList($owner = null) 
    {
        $query = BranchOffice::select('name', 'id')->whereHas(
            'company', function($q) use ($owner) {
                $q->where('owner_id', $owner);
            }
        )->pluck('name', 'id')->all();
        

        return ['' => 'Seleccionar su sucursales'] + $query;
    }

    public function searchLocalByGps($lat, $lng, $distance) 
    {
        $box = $this->getBoundaries($lat, $lng, $distance);
        $locales = BranchOffice::selectRaw('*, 
            (6371 * ACOS( 
                        COS( RADIANS('.$lat.') ) 
                        * COS( RADIANS(lat) ) 
                        * COS( RADIANS(lng) - RADIANS('.$lng.') ) 
                        + SIN( RADIANS('.$lat.') ) 
                        * SIN( RADIANS(lat) ) 
                    )
            ) as distance'
        )->whereBetween('lat', [$box['min_lat'], $box['max_lat']])
        ->whereBetween('lng', [$box['min_lng'], $box['max_lng']])
        ->having('distance', '<', $distance)
        ->orderBy('distance', 'ASC')
        ->take(5)->get();

        return $locales;
    }

    private function getBoundaries($lat, $lng, $distance = 1, $earthRadius = 6371)
    {
        $return = [];
        $earthRadius = 6371;
        $cardinalCoords =[
            'north' => '0',
            'south' => '180',
            'east' => '90',
            'west' => '270'
        ];
        $rLat = deg2rad($lat);
        $rLng = deg2rad($lng);
        $rAngDist = $distance/$earthRadius;

        $rLat = deg2rad($lat);
        $rLng = deg2rad($lng);
        $rAngDist = $distance/$earthRadius;
        
        foreach ($cardinalCoords as $name => $angle)
        {
            $rAngle = deg2rad($angle);
            $rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
            $rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));
            $return[$name] = array('lat' => (float) rad2deg($rLatB), 
                                    'lng' => (float) rad2deg($rLonB));
        }

        $bound = [ 
           'min_lat' => $return['south']['lat'],
            'max_lat' => $return['north']['lat'],
            'min_lng' => $return['west']['lng'],
            'max_lng' => $return['east']['lng']
        ];

        return $bound;
    }

}
