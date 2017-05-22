<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
        /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reservations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_office_id',
        'client_id',
        'date',
        'hour',
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

    public function getDateAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
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
                //$by = ($this->rejected_by == 'owner') ? '<span class="label label-danger">Por el dueño</span>' : '';
                $status = '<span class="label label-danger">'.trans("app.{$this->status}").'</span>';
        }

        return $status;
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
