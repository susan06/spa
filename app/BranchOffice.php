<?php

namespace App;

use Auth;
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
        'week',
        'min_time',
        'max_time',
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


    public function getFirsthPhoto() {
        
        return $this->photos->first()->name;
    }

    public function sumPrice() {
        $services = $this->services;
        $sum = 0;
        foreach ($services as $key => $value) {
            $sum += $value->price;
        }

        return $sum / $services->count();
    }

    public function isVisit() {

        $result = false;

        if(Auth::check() && Auth::user()->hasRole('client')) {
            $client = Auth::user()->id;
            $visit = Visit::where('client_id', $client)->where('branch_office_id', $this->id)->first();
            if($visit) {
                $result = true;
            }
        }

        return $result;
    }

    public function isScore() {

        $result = false;

        if(Auth::check() && Auth::user()->hasRole('client')) {
            $client = Auth::user()->id;
            $score = Score::where('client_id', $client)->where('branch_office_id', $this->id)->first();
            if($score) {
                $result = true;
            }
        }

        return $result;
    }


    public function isSave() {

        $result = false;

        if(Auth::check() && Auth::user()->hasRole('client')) {
            $client = Auth::user()->id;
            $favorite = Favorite::where('client_id', $client)->where('branch_office_id', $this->id)->first();
            if($favorite) {
                $result = true;
            }
        }

        return $result;
    }

    public function scoreByClient() {

        $score_html = '';

        if(Auth::check() && Auth::user()->hasRole('client')) {
            $score = Score::where('client_id', Auth::user()->id)->where('branch_office_id', $this->id)->first();
            $score_html = '';
            if($score) {
                $score_html .= '<div class="col-md-6 col-xs-6">';
                    $score_html .= '<div class="star-rating-comment">';
                    $score_html .= '<span> Servicio </span>';
                        for($i=1; $i <= 5; $i++) {
                            if($i <= $score->service) {
                                $score_html .= '<a href="#" class="active">&#9733;</a>';
                            } else {
                              $score_html .= '<a href="#" class="">&#9733;</a>';  
                            } 
                        }
                    $score_html .= '</div>';
                    $score_html .= '<div class="star-rating-comment">';
                    $score_html .= '<span> Ambiente </span>';
                        for($i=1; $i <= 5; $i++) {
                            if($i <= $score->environment) {
                                $score_html .= '<a href="#" class="active">&#9733;</a>';
                            } else {
                              $score_html .= '<a href="#" class="">&#9733;</a>';  
                            } 
                        }
                    $score_html .= '</div>';
                $score_html .= '</div>';

                $score_html .= '<div class="col-md-6 col-xs-6">';
                    $score_html .= '<div class="star-rating-comment">';
                    $score_html .= '<span> Atención </span>';
                        for($i=1; $i <= 5; $i++) {
                            if($i <= $score->attention) {
                                $score_html .= '<a href="#" class="active">&#9733;</a>';
                            } else {
                              $score_html .= '<a href="#" class="">&#9733;</a>';  
                            } 
                        }
                    $score_html .= '</div>';
                    $score_html .= '<div class="star-rating-comment">';
                    $score_html .= '<span> Precio </span>';
                        for($i=1; $i <= 5; $i++) {
                            if($i <= $score->price) {
                                $score_html .= '<a href="#" class="active">&#9733;</a>';
                            } else {
                              $score_html .= '<a href="#" class="">&#9733;</a>';  
                            } 
                        }
                    $score_html .= '</div>';
                $score_html .= '</div>';
            }
        }

        return $score_html;
    }

    /**
     * evalue if discount in reservation
     */
    public function isDescount()
    {
        $result = '';

        if($this->reservation_web) {
            switch($this->reservation_discount) {
                case true:
                    $result = '<span class="label label-success">Descuento en reserva</span>';
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

    public function score()
    {
        return $this->hasMany(Score::class, 'branch_office_id');
    }

     public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'branch_office_id');
    }

    public function visites()
    {
        return $this->hasMany(Visit::class, 'branch_office_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'branch_office_id');
    }

}
