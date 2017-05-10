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
    protected $attributes = ['name', 'lastname', 'email'];
    
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
    public function paginate_search($take = 10, $search = null, $status = null)
    {
        $query = User::query();

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

}