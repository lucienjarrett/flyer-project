@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-4">
	<h1> {!! $flyer->street !!}</h1>
	<h2> {!! $flyer->price !!}</h2>
	<hr>


<div class="description"> {!! nl2br($flyer->description) !!}</div>
</div>

<div class="col-md-8 gallery">
	@foreach ($flyer->photos->chunk(4) as $set)
	<div class="row">
		
		@foreach ($set as $photo)

		<div class="col-md-3 gallery_image">
		<img src="/{{ $photo->thumbnail_path}}" alt=""> 
		</div>
		@endforeach

	</div>

@endforeach

@if($user && $user->owns($flyer))


<hr>

<form 	id="addPhotosForm" 
		action="{{ route ('store_photo_path', [$flyer->zip, $flyer->street]) }}"
		class="dropzone" 
		method="POST">
	{{ csrf_field() }}
</form>
@endif
@stop
</div>
</div>





@section('scripts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>


<!-- <script src="/js/libs.js"></script> -->

<script>
	Dropzone.options.addPhotosForm = {
			paramName: 'photo', 
			maxFilesize: 3,
			acceptedFiles: '.jpg, .jpeg, .png, .bmp'

	}	
</script>

@stop