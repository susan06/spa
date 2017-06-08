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
        'offer',
        'offer_porcent',
        'status'
    ];

    /**
     * Functions
     *
     */
    public function getCreatedAtAttribute($date)
    {
        if($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
        }
    }

    public function getUpdatedAtAttribute($date)
    {
        if($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
        }
    }

    /**
     * evalue if discount 
     */
    public function isDescount()
    {
        $result = '';

        if($this->offer) {
            switch($this->offer_porcent) {
                case true:
                    $result = '<span class="label label-success">Descuento ('.$this->offer_porcent.'%)</span>';
                    break;

                case false:
                    $result = '';
                    break;

            }
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
}
