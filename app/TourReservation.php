<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TourReservation extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tours_reservations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tour_id',
        'client_id',
        'details_client',
        'status',
        'rejected_by'
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

    public function getStatus()
    {
        switch($this->status) {
            case 'pendient':
                $status = '<span class="label label-warning">'.trans("app.{$this->status}").'</span>';
                break;

            case 'approved':
                $status = '<span class="label label-success">'.trans("app.{$this->status}").'</span>';
                break;

            case 'rejected':
                if($this->rejected_by == 'owner') {
                    $status = '<span class="label label-danger">Cancelada por Dueño</span>';
                } else {
                    $status = '<span class="label label-danger">Cancelada por Dliente</span>';
                }
        }

        return $status;
    }

    /**
     * Relationships
     *
     */

     public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

}
