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
use Symfony\Component\HttpFoundation\File\UploadedFile; 
use App\User; 
use App\Http\Requests\ChangeFlyerRequest; 



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


        $user = Auth::user();

        $countries = Country::all(); 

         Auth::user()->flyers()->create($request->all()); 
       // Flyer::create($request->all()); 



 
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
    public function addPhoto($zip, $street, ChangeFlyerRequest $request)
    {

        $photo = $this->makePhoto($request->file('photo')); 

        Flyer::locatedAt($zip, $street)->addPhoto($photo); 
 
    }


    // public function userCreatedFlyer($request)
    // {
    //     $user = Auth::user();

    //     return $f = Flyer::where([
    //         'zip'=> $request->zip, 
    //         'street' => $request->street, 
    //         'user_id' => $user->id 

    //         ])->exists(); 
    //     echo $f; 
    // }

    // protected function unathorized(Request $request)
    // {

    //      if($request->ajax())
    //         {
    //             return response(['message'=>'No way'], 403); 
    //         }
    //         flash('no way'); 

    //         return redirect('/');
    // }

    public function makePhoto(UploadedFile $file)
    {
       

         return Photo::named($file->getClientOriginalName())
         ->move($file);
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
