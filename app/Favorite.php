<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'favorites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_office_id',
        'client_id'
    ];

    /**
     * Functions
     *
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    /**
     * Relationships
     *
     */

     public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class, 'branch_office_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
