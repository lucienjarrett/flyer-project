<?php

  namespace App\Http\Controllers\Traits; 
  use Illuminate\Http\Request; 
  use App\Flyer; 
  use Auth; 

  trait AuthorizesUsers {

   public function userCreatedFlyer(Request $request)
    {
       

        return Flyer::where([
            'zip' => $request->zip, 
            'street' => $request->street,
            'user_id' => Auth::user()->id
            ])->exists(); 

    }

    protected function unathorized(Request $request)
    {

         if($request->ajax())
            {
                return response(['message'=>'No way'], 403); 
            }
            flash('no way'); 

            return redirect('/');
    }
}