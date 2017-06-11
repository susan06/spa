<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
         /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_from', 
        'user_to', 
        'subject',
        'description',
        'delete_from', 
        'delete_to', 
        'read_on',
        'send_from'
    ];

    protected $casts = [
        'delete_from' => 'boolean',
        'delete_to' => 'boolean',
        'read_on' => 'boolean'
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

    public function isDelete()
    {
        $user = Auth::User()->id;

        switch($user) {
            case $this->user_to:
                $result = ($this->delete_to) ? true : false;
                break;

            case  $this->user_from:
                $result = ($this->delete_from) ? true : false;
                break;

            default:
                $result = true;
        }

        return $result;
    }

    public function title()
    {
        $user = Auth::User()->id;

        switch($user) {
            case $this->user_to:
                if($this->remitente->roles->first()->name == 'admin') {
                     $result = 'De: '.$this->remitente->roles->first()->display_name;
                } else {
                     $result = 'De: '.$this->remitente->full_name() .' | '.$this->remitente->roles->first()->display_name;
                }               
                break;

            case  $this->user_from:
                if($this->destinatario->roles->first()->name == 'admin') {
                     $result = '<span class="text-gray">Para: '.$this->destinatario->roles->first()->display_name.'</span>';
                } else {
                     $result = '<span class="text-gray">Para: '.$this->destinatario->full_name() .' | '.$this->destinatario->roles->first()->display_name.'</span>';
                }   
                break;

            default:
                $result = true;
        }

        return $result;
    }

    /**
     * Relationships
     *
     */

    public function remitente()
    {
        return $this->belongsTo(User::class, 'user_from');
    }

    public function destinatario()
    {
        return $this->belongsTo(User::class, 'user_to');
    }
}
