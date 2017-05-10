<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\Model;
use App\Support\Authorization\AuthorizationRoleTrait;

class Role extends EntrustRole
{
    use AuthorizationRoleTrait;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description', 'removable'
    ];

     /**
     * Field type
     *
     * @var array
     */
    protected $casts = [
        'removable' => 'boolean'
    ];

     /**
     * Relationships
     *
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

        /**
     * get rolcolor text
     */
    public function RolColor()
    {
        switch($this->name) {

            case "admin":
                $text = '<span class="label label-info">'.trans("app.$this->name").'</span>';
                break;

            case "supervisor":
                $text = '<span class="label label-success">'.trans("app.$this->name").'</span>';
                break;

            case "seller":
                $text = '<span class="label label-primary">'.trans("app.$this->name").'</span>';
                break;

            case "operator":
                $text = '<span class="label label-warning">'.trans("app.$this->name").'</span>';
                break;

            case "agency":
                $text = '<span class="label label-success">'.trans("app.$this->name").'</span>';
                break;

            default:
                $text = '';
        }

        return $text;
    }

}
