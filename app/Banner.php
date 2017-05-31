<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'priority', 
        'name', 
        'details',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];


    /**
     * get span label status
     */
    public function getStatus()
    {
        switch($this->status) {
            case true:
                $class = '<span class="label label-success">'.trans("app.Published").'</span>';
                break;

            case false:
                $class = '<span class="label label-danger">'.trans("app.No Published").'</span>';
                break;

            default:
                $class = '';
        }

        return $class;
    }

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
}
