@extends('layouts.plantilla')

@section('title', 'Galeria de imágenes')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    	<h2 class="h2">#Modificar regristro</h2>
    	<div class="btn-toolbar mb-2 mb-md-0">
      		<div class="btn-group me-2">
        		<a href="{{route('tour.index')}}" class="btn btn-outline-primary">Volver</a>
      		</div>
    	</div>
  	</div>

	<div class="cont-formulario">
		
		<form action="{{ route('tour.update', $tour) }}" method="POST" enctype="multipart/form-data">
			
			@csrf
			
			@method('put')

			<div class="row">
			  	
			  	<div class="col">
				    <label for="categoria">Título</label>
				    <input type="text" name="title" class="form-control"  value="{{ $tour->title }}">
			  	</div>

			  	@error('title')
			  		<small>*{{$message}}</small>
			  	@enderror
			</div>  	 	

		  	<br>
		  	<div class="row">
			  	
			  	<div class="col">
				    <label for="categoria">Enlace</label>
				    <input type="text" name="url" class="form-control"  value="{{ $tour->url }}">
			  	</div>

			  	@error('url')
			  		<small>*{{$message}}</small>
			  	@enderror

			</div>  	
		  	<br>

			<div class="row">
			  	<div class="col">
			    	<label for="img">
			    		File
				    	<input type="file" name="img" class="form-control-file" id="img">
			    	</label>
				</div>
		    	<div class="col">
		  			<img src="{{asset('assets/tourvirtual360/' .$tour->img_inicial. '')}}" width="100px">
		  		</div>

				@error('file')
			  		<small>*{{$message}}</small>
			  	@enderror
			</div>  	

		  	<br>
			<div class="row">
			  	<div class="col form-check">
				    <label class="form-check-label" for="state">
				    	<input type="checkbox" class="form-check-input" name="state" value="1" id="state"  @if($tour->state!=0) checked @endif >
				    	Estado
				    </label>
			  	</div>
			</div>
		  	
		  	<br>
		  	<div class="row">
		  		<div class="col">
		  			<button type="submit" class="btn btn-primary">Modificar</button>
		  		</div>
		  	</div>		

		</form>

	</div>

	<script type="text/javascript">
		
		document.querySelector('#state').addEventListener('click', function() {
			this.value = (!this.checked) ? 0 : 1;
		}, false);

	</script>

@endsection
