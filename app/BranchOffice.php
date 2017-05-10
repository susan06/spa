<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branch_offices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'province_id', 
        'name',
        'address',
        'address_description',
        'lat',
        'lng',
        'phone_one',
        'phone_second',
        'working_hours',
    	'domicile',
        'email',
        'reservation_web',
        'reservation_discount',
        'percent_discount',
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'branch_office_id');
    }

     public function photos()
    {
        return $this->hasMany(Photo::class, 'branch_office_id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'branch_office_id');
    }
}
