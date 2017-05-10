<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MethodPayment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'method_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'icon'
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

}
