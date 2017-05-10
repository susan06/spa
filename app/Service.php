<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_office_id',
        'name',
        'details',
        'price',
        'status'
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
}
