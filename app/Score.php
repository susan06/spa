<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_office_id',
        'client_id',
        'service',
        'environment',
        'attention',
        'price'
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

    public function getFirsthPhoto() {
        
        return $this->branchOffice->photos->first()->name;
    }

    public function sumScore() {
        $sum = ($this->sum('service') + $this->sum('environment') + $this->sum('attention') + $this->sum('price')) / 5;

        return $sum.'/5';
    }

    public function sumPrice() {
        $services = $this->branchOffice->services;
        $sum = 0;
        foreach ($services as $key => $value) {
            $sum += $value->price;
        }

        return $sum / $services->count();
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
