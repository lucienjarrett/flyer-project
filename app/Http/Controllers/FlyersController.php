<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo; 
use App\Http\Requests;
use App\Http\Utilities\Country; //created a ultility class to hold all countries
use App\Http\Requests\FlyerRequest;
use App\Flyer;
use Auth;  
use App\Http\Flash;
//use Symfony\Component\HttpFoundation\File\UploadedFile; 
use App\User; 
// use App\Http\Requests\AddPhotoRequest; 
use Session; 


class FlyersController extends Controller
{
    
    //use AuthorizesUsers; 

    public function __construct()
    {
        $this->middleware('auth', ['except'=>'show']); 

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all(); 


        //dd(flash()->success('Success!','Flyer successfully created'));
        return view('flyers.create', compact('countries'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        $user = Auth::user();
        
        $flyer = $this->$user->publish(
            new Flyer($request->all())); 
 

       flash()->success('Success!','Flyer successfully created');
       return redirect(flyer_path($flyer));
        
    }
    /**
     * Scope query to those located at the given address..
     * @param Builder $query
     * @param  string  $zip, string street
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
 

       $flyer = Flyer::locatedAt($zip, $street);

        $user = Auth::user(); 

        return view('flyers.show', compact('flyer', 'user')); 
        //return view('flyers.show', compact('flyer', 'user')); 


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
