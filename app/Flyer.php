<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    protected $fillable = array('street', 'state', 'city', 'price', 'description', 'zip', 'country');
    

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
    	return static::where(compact('zip', 'street'))->first(); 

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

 }
