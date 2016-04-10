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



class FlyersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth'); 

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

        flash()->success('Success!','Flyer successfully created');
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

        $countries = Country::all(); 

        
        

        Flyer::create($request->all());

 
       flash()->success('Success!','Flyer successfully created');
        return redirect()->back();
        
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

        return view('flyers.show', compact('flyer')); 

    }


    /**
     * [addPhoto description]
     * @param [type]  $zip     [description]
     * @param [type]  $street  [description]
     * @param Request $request [description]
     */
    public function addPhoto($zip, $street, Request $request)
    {


        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,jpg,bmp,png'
            ]);
        
        $photo = Photo::fromForm($request->file('photo'));         
        Flyer::locatedAt($zip, $street)->addPhoto($photo);
 
        return "Done"; 
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
