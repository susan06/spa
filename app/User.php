<?php

namespace App;

use DateTime;
use Settings;
use Session;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Support\Authorization\AuthorizationUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Support\User\UserStatus;

class User extends Authenticatable
{
    use Notifiable, AuthorizationUserTrait;

    protected $dates = ['last_login', 'birthday'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'lastname', 
        'email',
        'username', 
        'password', 
        'status',
        'avatar', 
        'lang', 
        'last_login', 
        'birthday',
        'phone',
        'mobile',
        'address',
        'online',
        'confirmation_token',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'online' => 'boolean'
    ];

    /**
     * Functions
     *
     */

    /**
     * Format name, first letter in upper case
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

    /**
     * Format last name, first letter in upper case
     */
    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords(strtolower($value));
    }

    /**
     * Format Password, Encryption
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Format Date Birthday dd-mm-yyyy
     */
    public function setBirthdayAttribute($value)
    {
        if ($value) {
            $this->attributes['birthday'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        }  
    }

    /**
     * get full name
     */
    public function full_name()
    {
        return $this->name.' '.$this->lastname;
    }

    /**
     * get image of avatar
     */
    public function avatar()
    {
        if (! $this->avatar ) {
            return asset('images/noimage.png');
        }

        return url('img-file/users/'.$this->avatar);
    }

    /**
     * Format Date Birthday dd-mm-yyyy
     */
    public function getBirthdayAttribute($date)
    {
        if ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        }
    }

    /**
     * Format Date create_at dd-mm-yyyy hh:mm s
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y h:i A');
    }

    /**
     * Format Date update_at dd-mm-yyyy hh:mm s
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y h:i A');
    }

    /**
     * Format Date Birthday dd-mm-yyyy
     
    public function getLastLoginAttribute($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y G:ia');
        }
    }
    */

    /**
     * Evaluate if confirmed
     */
    public function isUnconfirmed()
    {
        return $this->status == UserStatus::UNCONFIRMED;
    }

    /**
     * Evaluate if active
     */
    public function isActive()
    {
        return $this->status == UserStatus::ACTIVE;
    }

    /**
     * Evaluate if banned
     */
    public function isBanned()
    {
        return $this->status == UserStatus::BANNED;
    }

    /**
     * get span label status
     */
    public function labelStatus()
    {
        switch($this->status) {
            case UserStatus::ACTIVE:
                $class = '<span class="label label-success">'.trans("app.{$this->status}").'</span>';
                break;

            case UserStatus::BANNED:
                $class = '<span class="label label-danger">'.trans("app.{$this->status}").'</span>';
                break;

            default:
                $class = '<span class="label label-warning">'.trans("app.{$this->status}").'</span>';
        }

        return $class;
    }

    /**
     * Evaluate if online
     */
    public function isOnline()
    {
        switch($this->online) {
            case true:
                $class = '<span class="badge bg-nav badge-green">&nbsp;</span>';
                break;

            case false:
                $class = '<span class="badge badge-gray">&nbsp;</span>';
                break;

            default:
                $class = '<span class="badge">&nbsp;</span>';
        }

        return $class;
    }

    /**
     * get time of login
     */
    public function timeLogin()
    {
        $time = '';
        if ( $this->last_login ) {
            $date1 = new DateTime(Carbon::now());
            $date2 = new DateTime($this->last_login);
            $diff = $date1->diff($date2);

            if( $diff->d) {
                $time.= 'hace '.$diff->d.' días, ';
            }
            if( $diff->h) {
                $time.= $diff->h.' horas y ';
            }
            $time.= $diff->i.' segundos';
        }

        return  $time;
    }


    /**
     * Relationships
     *
     */

    public function roles(){
        
        return $this->belongsToMany('App\Role');
    }


}
