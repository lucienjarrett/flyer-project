<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    protected $fillable = array('street', 'state', 'city', 'price', 'description', 'zip', 'country', 'user_id');
    

    /**
     * [photos description]
     * @return [type] [description]
     */
    public function photos()
    {
    	return $this->hasMany('App\Photo'); 

    }


    /**
     * [locatedAt description]
     * @param  [type] $zip    [description]
     * @param  [type] $street [description]
     * @return [type]         [description]
     */
    public static function locatedAt( $zip, $street)
    {
    	$street = trim(str_replace('-', ' ', $street)); 
    	
        return static::where(compact('zip', 'street'))->firstOrFail(); 

    }

    public function getPriceAttribute($price)
    {
    	return '$' . number_format($price); 

    }


    /**
     * [addPhoto description]
     * @param Photo $photo [description]
     */
    public function addPhoto(Photo $photo)
    {
    
        return $this->photos()->save($photo); 
    }

    /**
     * [user description]
     * @return namespace Illuminate\Database\Eloquent\Relations\BelongsTo;
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');  

    }

    
    /**
     * Determine if the giev user created the flyer. 
     * @param  User   $user [description]
     * @return [boolean]       [description]
     */
    public function ownedBy(User $user)
    {
        
        return $this->user_id == $user->id; 
    }

 }
