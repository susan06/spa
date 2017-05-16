<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_office_id',
        'client_id',
        'content'
    ];

    /**
     * Functions
     *
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
    }

    public function scoreByClient($branch) {

        $score = Score::where('client_id', $this->client_id)->where('branch_office_id', $branch)->first();
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

        return $score_html;
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
