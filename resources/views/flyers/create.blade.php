

@extends('layouts.app')
@section('content')
<h1>Selling Your Home?</h1>
<hr>
<form method="POST" action ="/flyers" enctype="multipart/form-data">
	@include('flyers.form')

	@if (count($errors) > 0 ) 
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
			<li>
				{{ $error }}
			</li> 

			@endforeach 
		</ul>
	</div>

	@endif 
</form>

@stop 