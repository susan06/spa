<?php

namespace App\Repositories\Activity;

use DB;
use Carbon\Carbon;
use App\User;
use Regulus\ActivityLog\Models\Activity;
use App\Repositories\Repository;

class EloquentActivity extends Repository implements ActivityRepository
{
    /**
     * EloquentActivity constructor
     *
     * @param Activity $activity
     */
    public function __construct(Activity $activity)
    {
        parent::__construct($activity);
    }

    /**
     * Paginate and search
     *
     * return the result paginated for the take value and with the attributes.
     *
     * @param int $take
     * @param string $search
     *
     * @return mixed
     *
     */
    public function paginate_search($take = 10, $user = null, $status = null)
    {
        if ($user) {
           $query = Activity::where('user_id', $user);
        } else {
           $query = Activity::query();  
        }

        if ($status) {
            $query->where('content_type', $status);
        }

        $result = $query->paginate($take);

        if ($status) {
            $result->appends(['status' => $status]);
        }

        if ($user) {
            $result->appends(['user' => $user]);
        }

        return $result;
    }

    /**
     * lists logs type
     */
    public function list_log_type()
    {
        $result = array();
        $activities = Activity::all();
        foreach ($activities as $activity) {
            $result[$activity['content_type']] = trans('log.'.$activity['content_type']);
        }

        return array_unique($result);
    }

    /**
     *  get activities for user
     */
    public function getLatestActivitiesForUser($userId, $take = 10)
    {
        return Activity::where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit($take)
            ->get();
    }

    /**
     *  get all activities of model
     */
    public function all_by_model($id, $model)
    {
        $result = Activity::where('content_type', $model)
            ->where('content_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        return $result;
    }

    /**
     *   userA ctivity For Period
     */
    public function userActivityForPeriod($userId, Carbon $from, Carbon $to)
    {
        $result = Activity::select([
            DB::raw("DATE(created_at) as day"),
            DB::raw('count(id) as count')
        ])
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('day')
            ->orderBy('day', 'ASC')
            ->get();

        while(! $from->isSameDay($to)) {
            if (! $result->has($from->toDateString())) {
                $result->put($from->toDateString(), 0);
            }
            $from->addDay();
        }

        return $result->sortBy(function ($value, $key) {
            return strtotime($key);
        });
    }
}