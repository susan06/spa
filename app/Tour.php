<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_office_id',
        'title',
        'date_start',
        'date_end',
        'view_start',
        'view_end',
        'description',
        'view'
    ];

    protected $casts = [
        'view' => 'boolean'
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

    public function rangeDate() 
    {
        $start = Carbon::createFromFormat('Y-m-d', $this->date_start)->format('d/m/Y');
        $end = Carbon::createFromFormat('Y-m-d', $this->date_end)->format('d/m/Y');

        return $start.' - '.$end;
    }

    public function getStatus()
    {
        $result = '';

        switch($this->view) {
            case true:
                $result = '';
                break;

            case false:
                $result = ' <span class="label label-danger">No pública</span>';
                break;

        }
    
        return $result;
    }

    /**
     * Relationships
     *
     */

     public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class, 'branch_office_id');
    }

    public function reservations()
    {
        return $this->hasMany(TourReservation::class, 'tour_id');
    }
}
