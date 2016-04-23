<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flyer; 
use App\Photo; 
use App\Http\Requests;
use App\Http\Requests\AddPhotoRequest; 
use App\Http\Controllers\Controllers; 
use App\AddPhotoToFlyer; 


class PhotosController extends Controller
{
 
    /**
     * [addPhoto description]
     * @param [type]  $zip     [description]
     * @param [type]  $street  [description]
     * @param Request $request [description]
     */
    public function store($zip, $street, AddPhotoRequest $request)
    { 

        $flyer = Flyer::locatedAt($zip, $street); 
        
        $photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save(); 


    }


}
