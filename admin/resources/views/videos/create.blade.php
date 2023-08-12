@extends('layouts.plantilla')

@section('title', 'Galeria de imágenes')

@section('content')

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    	<h2 class="h2">#Crear nuevo video</h2>
    	<div class="btn-toolbar mb-2 mb-md-0">
      		<div class="btn-group me-2">
        		<a href="{{route('videos.index')}}" class="btn btn-outline-primary">Volver</a>
      		</div>
    	</div>
  	</div>
	
	<div class="cont-formulario">
	
		<form action="{{route('videos.store')}}" method="POST">
			
			@csrf

		  	<div class="row">
			  	
			  	<div class="col">
			    	<label for="title">Título</label>
			    	<input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
		  		</div>

			  	@error('title')
			  		<small>*{{$message}}</small>
			  	@enderror
			
			</div>

			<br>
			<div class="row">
			  	
			  	<div class="col">
			    	<label for="url">Enlace</label>
			    	<input type="text" name="url" class="form-control" id="url" value="{{ old('url') }}">
		  		</div>

			  	@error('url')
			  		<small>*{{$message}}</small>
			  	@enderror
			
			</div>

			<br>
			<div class="row">

			  	<div class=" col form-check">
				    <input type="checkbox" class="form-check-input" name="state" value="1" id="state" checked>
				    <label class="form-check-label" for="state">Estado</label>
			  	</div>

			</div>

			<br>
		  	<div class="row">
		  		<div class="col">
		  			<button type="submit" class="btn btn-primary">Cargar</button>
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
