<?php

namespace App\Repositories\User;

use DB;
use App\User;
use App\Role;
use Carbon\Carbon;
use App\Repositories\Repository;

class EloquentUser extends Repository implements UserRepository
{
     /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['name', 'lastname', 'email', 'created_at'];
    
    /**
     * EloquentUser constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
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
    public function paginate_search($take = 10, $search = null, $status = null, $role = null)
    {
        $query = User::query();

        if ($role) {
            $query->orwhereHas(
                'roles', function($q) use ($role) {
                    $q->where('name', $role);
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

        if ($status) {
            $query->where('status', $status);
        }

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        if ($role) {
            $result->appends(['role' => $role]);
        }

        return $result;
    }

     /**
     * Find user by confirmation token.
     *
     * @param $token
     * @return mixed
     */
    public function findByConfirmationToken($token)
    {
        return $this->model->where('confirmation_token', $token)->first();
    }

    /**
     * Find user by email.
     *
     * @param $token
     */
    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Set specified role to specified user.
     *
     * @param $userId
     * @param array $roles
     * @return mixed
     */
    public function setRole($userId, $roles)
    { 
        foreach ($roles as $key => $value) {
          $this->model->find($userId)->roles()->attach($value);      
        } 
    }

    /**
     * update roles of user
     *
     * @param $userId
     * @param array $roles
     */    
    public function updateRole($userId, $roles)
    {
        $this->model->find($userId)->roles()->sync([]);
        $this->setRole($userId, $roles);
    }

    /**
     * newUsersCount     
     */
    public function newUsersCount()
    {
        return User::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])
            ->count();
    }

    /**
     * countByStatus
     */
    public function countByStatus($status)
    {
        return User::where('status', $status)->count();
    }

    /**
     * latest
     */
    public function latest($count = 20)
    {
        return User::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

    /**
     * get admin data
     *
     */
    public function getAdmin()
    {
        $query = User::whereHas(
            'roles', function($q){
                $q->where('name','=', 'admin');
            }
        )->first();

        return $query;
    }

    /**
     * count clientes
     *
     *
     */
    public function countByRole($role)
    {
        $result = User::whereHas(
                'roles', function($q) use($role){
                    $q->where('name', $role);
                }
            );

        return $result->count();
    } 

    /**
     * Paginate and search by clients
     *
     *
     */
    public function paginate_search_client($take = 10, $search = null)
    {
        $query = User::whereHas(
                'roles', function($q) {
                    $q->where('name', 'client');
                }
            );

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

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * count clientes
     *
     *
     */
    public function totalClients()
    {
        $query = User::whereHas(
                'roles', function($q) {
                    $q->where('name', 'client');
                }
            );

        $total['totales'] = $query->count();
        $total['3meses'] = $query->where(function($q){
                $q->where('last_login', '>=', Carbon::now()->subMonths(3));
                $q->where('last_login', '<=', Carbon::now());
            })->count();

        return $total;
    } 

    /**
     * get list of user with role owner
     *
     */
    public function list_owner()
    {
        $query = User::select(DB::raw("CONCAT(name,' ',lastname) AS owner"), 'id')->whereHas(
            'roles', function($q){
                $q->where('name','=', 'owner');
            }
        )->pluck('owner', 'id')->all();

        return ['' => trans('app.select_owner')] +  $query;
    }

    /**
     * get list of user with role owner and client
     *
     */
    public function list_owner_client()
    {
        $query = User::select(
            DB::raw("CONCAT(users.name,' ',users.lastname,' - ', roles.display_name) AS user"), 'users.id')
            ->whereHas(
            'roles', function($q){
                $q->where('name','=', 'owner');
                $q->orWhere('name','=', 'client');
            }
        )
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->pluck('user', 'users.id')->all();

        return ['' => 'Seleccionar Destinatario'] +  $query;
    }


}