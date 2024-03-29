<?php

namespace App;
use App\Flyer; 

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function flyers()
    {

       return $this->hasMany('App\Flyer'); 
        
    }

    public function owns($relation)
    {
        return $relation->user_id == $this->id; 

    }

    public function publish(Flyer $flyer)
    {

        return $this->flyers()->save($flyer); 
    }
}
