@extends('layouts.app')
@section('content')
   <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
		<h1> Project Flyer</h1>

        <p>
        	This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.
        </p>
  @if (Auth::guest())
  		
 <a href="auth/register" class="btn btn-primary">Sign Up</a>
                       
           @else         
        <a href="/flyers/create" class="btn btn-primary">Create Flyer</a>

        @endif
      </div>

@stop
